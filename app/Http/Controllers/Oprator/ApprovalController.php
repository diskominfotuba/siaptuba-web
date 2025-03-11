<?php

namespace App\Http\Controllers\Oprator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use App\Models\Approval;

class ApprovalController extends Controller
{
    protected $user;
    public function __construct(UserService $userService)
    {
        $this->user = $userService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if($request->search) {
                $table = $this->user->Query()
                ->where('opd_id', Auth::user()->opd_id)
                ->whereHas('approval')
                ->where('nama', 'like', '%' . $request->search . '%')
                ->select('id', 'nama', 'unit_organisasi')
                ->get();
                return view('oprator.approval._data_table_user', compact('table'));
            }else {
                $table = $this->user->Query()->where('opd_id', Auth::user()->opd_id)->whereHas('approval')->select('id', 'nama', 'unit_organisasi')->limit(1000)->get();
                return view('oprator.approval._data_table_user', compact('table'));
            }
        }

        $data['title'] = "Approval";
        $data['approvals'] = $this->user->Query()->where('opd_id', Auth::user()->opd_id)->select('id', 'nama')->limit(1000)->get();
        return view('oprator.approval.index', $data);
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            if($request->search) {
                $table = $this->user->Query()
                ->where('opd_id', Auth::user()->opd_id)
                ->whereDoesntHave('approval')
                ->where('nama', 'like', '%' . $request->search . '%')
                ->select('id', 'nama', 'unit_organisasi')
                ->get();
                return view('oprator.approval._data_table_approval', compact('table'));
            }else {
                $table = $this->user->Query()->where('opd_id', Auth::user()->opd_id)->whereDoesntHave('approval')->select('id', 'nama', 'unit_organisasi')->limit(1000)->get();
                return view('oprator.approval._data_table_approval', compact('table'));
            }
        }

        $data['title'] = "Approval";
        $data['approvals'] = $this->user->Query()->where('opd_id', Auth::user()->opd_id)->select('id', 'nama')->limit(1000)->get(1000);
        return view('oprator.approval.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'users' => 'required|array',
            'approval_id' => 'required|string',
        ]);

        foreach ($validated['users'] as $userId) {
            Approval::updateOrCreate(
                [
                    'opd_id'    => Auth::user()->opd_id,
                    'user_id' => $userId,
                    'approval_id' => $validated['approval_id']
                ],
            );
        }

        return $this->success('OKE', 'Pemberi persetujuan berhasil disubmit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'users' => 'required|array',
            'approval_id' => 'required|string',
        ]);

        foreach ($validated['users'] as $userId) {
            $approval = Approval::where('user_id', $userId)->first();

            if ($approval) {
                $approval->update(['approval_id' => $validated['approval_id']]);
            }
        }
        return $this->success('OKE', 'Pemberi persetujuan berhasil diupdate');
    }
}
