<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Services\BaseService;
use App\Services\PresensiService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Tpp;

class ApprovalController extends Controller
{
    protected $presensi;
    protected $approval;
    public function __construct(PresensiService $presensiService, Approval $approval)
    {
        $this->presensi = $presensiService;
        $this->approval = new BaseService($approval);
    }

    public function index(Request $request)
    {
        $cek_approval = $this->approval->Query()->where('approval_id', Auth::user()->id)->first();
        if (!$cek_approval) {
            return \redirect('/user/dashboard');
        }

        $presensi = $this->presensi->Query()->where('opd_id',  Auth::user()->opd_id);
        if ($request->ajax()) {

            if(\request()->status) {
                $presensi->where('approval_status', \request()->status);
            }

            $table = $presensi->whereHas('user.approval', function ($query) {
                $query->where('approval_id', Auth::user()->id);
            })->with('user')->get();

            return view('users.approval._data_table', compact('table'));
        }

        $data['title'] = "Approval";
        $data['total_pending'] = $presensi->where('approval_status', 'pending')->whereHas('user.approval', function ($query) {
            $query->where('approval_id', Auth::user()->id);
        })->with('user')->count();

        $data['total_dl'] = $this->presensi->Query()
        ->where('status', 'Dinas Luar (DL)')
        ->where('opd_id', Auth::user()->opd_id)
        ->whereHas('user.approval', function ($query) {
            $query->where('approval_id', Auth::user()->id);
        })->with('user')->count();

        return view('users.approval.index', $data);
    }

    public function show($id)
    {
        $data = $this->presensi->Query()->where('status', 'Dinas Luar (DL)')->where('approval_status', 'pending')->whereHas('user.approval', function ($query) {
            $query->where('approval_id', Auth::user()->id);
        })->with('user')->findOrFail($id);
        return view('users.approval.show', compact('data'));
    }

    public function update($id)
    {
        $presensi =
            $this->presensi->Query()->where('status', 'Dinas Luar (DL)')->where('approval_status', 'pending')->whereHas('user.approval', function ($query) {
                $query->where('approval_id', Auth::user()->id);
            })->with('user')->findOrFail($id);
        $validator = Validator::make(request()->all(), [
            'approval_status'  => 'required|in:pending,ditolak,disetujui',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data['approval_status'] = request()->approval_status;
        $user = $presensi->user;

        DB::beginTransaction();
        try {
            $this->presensi->update($presensi, $data);

            if ($data['approval_status'] == 'disetujui') {
                $tpp = Tpp::where('user_id', Auth::id())
                          ->whereDate('created_at', $presensi->created_at)
                          ->first();
                if ($tpp) {
                    $tpp->delete();
                }
            }

            if($data['approval_status'] == 'ditolak') {

                $tpp_saat_ini = Tpp::where('user_id', $user->id)
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month) // bulan saat ini
                ->latest()
                ->first();

                $pengurangan_tpp = 0.6 / 100 * $user->tpp; // 1.50% potongan

                if($tpp_saat_ini) {
                    $tpp_hasil_pengurangan = $tpp_saat_ini->tpp_berjalan - $pengurangan_tpp;
                    Tpp::create([
                        'user_id'       => $user->id,
                        'tpp_berjalan'  => $tpp_hasil_pengurangan,
                        'jumlah_menit'  => 'Presensi DL ditolak!',
                        'pengurangan'   => $pengurangan_tpp,
                        'keterangan'    => 'Presensi DL ditolak!',
                        'created_at'    => $presensi->created_at,
                    ]);
                }else {
                    $tpp_hasil_pengurangan = $user->tpp - $pengurangan_tpp;
                    Tpp::create([
                        'user_id'       => $user->id,
                        'tpp_berjalan'  => $tpp_hasil_pengurangan,
                        'jumlah_menit'  => 'Presensi DL ditolak!',
                        'pengurangan'   => $pengurangan_tpp,
                        'keterangan'    => 'Presensi DL ditolak!',
                        'created_at'    => $presensi->created_at,
                    ]);
                }
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->error($th->getMessage());
        }

        DB::commit();
        Cache::forget('table_dashboard_' . $user->id);
        return $this->success($data, 'Data berhasil ' . request()->approval_status);
    }
}
