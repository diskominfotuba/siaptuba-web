<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Cuty;
use App\Models\Izin;
use App\Models\Tpp;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApprovalCutiController extends Controller
{
    protected $approval;
    protected $izin;
    public function __construct(Approval $approval, Izin $izin)
    {
        $this->approval = new BaseService($approval);
        $this->izin = new BaseService($izin);
    }

    public function index(Request $request)
    {
        $cek_approval = $this->approval->Query()->where('approval_id', Auth::user()->id)->first();
        if (!$cek_approval) {
            return \redirect('/user/dashboard');
        }

        $izin = $this->izin->Query()->where('opd_id',  Auth::user()->opd_id);
        if ($request->ajax()) {

            if (\request()->status) {
                $izin->where('approval_status', \request()->status);
            }

            $table = $izin->whereHas('user.approval', function ($query) {
                $query->where('approval_id', Auth::user()->id);
            })->with('user')->get();

            return view('users.approvalcuti._data_table', compact('table'));
        }

        $data['title'] = "Approval";
        $data['total_pending'] = $izin->where('approval_status', 'pending')->whereHas('user.approval', function ($query) {
            $query->where('approval_id', Auth::user()->id);
        })->with('user')->count();

        $data['total_dl'] = $this->izin->Query()
            ->where('opd_id', Auth::user()->opd_id)
            ->whereHas('user.approval', function ($query) {
                $query->where('approval_id', Auth::user()->id);
            })->with('user')->count();

        return view('users.approvalcuti.index', $data);
    }

    public function show($id)
    {
        $data = $this->izin->Query()->where('approval_status', 'pending')->whereHas('user.approval', function ($query) {
            $query->where('approval_id', Auth::user()->id);
        })->with('user')->findOrFail($id);
        return view('users.approvalcuti.show', compact('data'));
    }

    public function update($id)
    {
        $izin =
            $this->izin->Query()->where('approval_status', 'pending')->whereHas('user.approval', function ($query) {
                $query->where('approval_id', Auth::user()->id);
            })->with('user')->findOrFail($id);

        $validator = Validator::make(request()->all(), [
            'approval_status'  => 'required|in:pending,ditolak,disetujui',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data['approval_status'] = request()->approval_status;
        $user = $izin->user;

        DB::beginTransaction();
        try {
            $this->izin->update($izin, $data);

            if ($data['approval_status'] == 'ditolak') {

                $tpp_saat_ini = Tpp::where('user_id', $user->id)
                    ->whereYear('created_at', $izin->created_at->format('Y')) // tahun saat ini
                    ->whereMonth('created_at', $izin->created_at->format('m')) // bulan saat ini
                    ->latest()
                    ->first();

                $pengurangan_tpp = 0.6 / 100 * $user->tpp; // 1.50% potongan

                if ($tpp_saat_ini) {
                    $tpp_hasil_pengurangan = $tpp_saat_ini->tpp_berjalan - $pengurangan_tpp;
                    Tpp::create([
                        'user_id'       => $user->id,
                        'tpp_berjalan'  => $tpp_hasil_pengurangan,
                        'jumlah_menit'  => 'Cuti/Izin ditolak!',
                        'pengurangan'   => $pengurangan_tpp,
                        'keterangan'    => 'Cuti/Izin ditolak!',
                        'created_at'    => $izin->created_at,
                    ]);
                } else {
                    $tpp_hasil_pengurangan = $user->tpp - $pengurangan_tpp;
                    Tpp::create([
                        'user_id'       => $user->id,
                        'tpp_berjalan'  => $tpp_hasil_pengurangan,
                        'jumlah_menit'  => 'Cuti/Izin ditolak!',
                        'pengurangan'   => $pengurangan_tpp,
                        'keterangan'    => 'Cuti/Izin ditolak!',
                        'created_at'    => $izin->created_at,
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
