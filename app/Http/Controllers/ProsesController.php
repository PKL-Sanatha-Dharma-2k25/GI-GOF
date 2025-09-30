<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\PemohonModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\PermohonanModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;

class ProsesController extends Controller
{
        public function index(): View
    {
        return view('content.create');
    }
        public function simpanPermohonan(Request $request): RedirectResponse {
           //dd($request->all());
        $request->validate([
            'nama_item' => ['required', 'string', 'max:255'],
            'tgl_pengajuan' => ['required', 'date'],
            'kepentingan' => ['required','string', 'max:255'],
            'alasan' => ['required','string', 'max:255'],
            'file_upload' => ['required','image','mimes:jpeg,jpg,png,webp', 'max:10240'],
        ]);
        $image = $request->file('file_upload');
        $path = $image->storeAs('permohonans', $image->hashName(), 'public');
        $data = PermohonanModel::create([
            'nama_item' => $request->nama_item,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'kepentingan' => $request->kepentingan,
            'alasan' => $request->alasan,
            'foto_item_sebelum' => $path,
            'pemohon_id' => session('user.id'),
        ]);
        //event(new Registered($data));


        //Session::flash('msgUp', 'You have successfully signed up, please login');
   return redirect()->back()->with('success', 'Permohonan telah dibuat.');
    }
    public function detail($id)
{
    $permohonan = PermohonanModel::find($id);
            if (!$permohonan) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        
    return response()->json([
        'id'          => $permohonan->id,
        'nama_item'   => $permohonan->nama_item,
        'kepentingan' => $permohonan->kepentingan,
        'alasan'      => $permohonan->alasan,
        'status'      => $permohonan->status,
        'tgl_pengajuan'   => $permohonan->tgl_pengajuan ?? '-',
        'tgl_selesai'     => $permohonan->tgl_selesai ?? '-',
        'foto_item_sebelum' => $permohonan->foto_item_sebelum,
    ]);
}
public function approve(Request $request)
{ 
    $permohonan = PermohonanModel::find($request->id);
    if ($permohonan) {
        $permohonan->status = 'Approved';
        $permohonan->peninjau_id = $request->peninjau_id;
        $permohonan->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}

public function reject(Request $request)
{
    $permohonan = PermohonanModel::find($request->id);
    if ($permohonan) {
        $permohonan->status = 'Rejected';
        $permohonan->peninjau_id = $request->peninjau_id;
        $permohonan->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}



}