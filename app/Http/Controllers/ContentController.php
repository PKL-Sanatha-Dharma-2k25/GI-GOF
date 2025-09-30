<?php

namespace App\Http\Controllers;

use App\Models\PemohonModel;
use App\Models\PermohonanModel;
use Illuminate\Http\Request;
use Illuminate\View\View;
class ContentController extends Controller
{
    // public function __construct()
    // {
    //     if ((int)Session::get('id_role') !== 2 && (int)Session::get('id_role') !== 3) {
    //         Session::flash('msgOut', 'Akses ditolak atau halaman tidak ditemukan.');
    //         abort(404);
    //     }
    // }
    // -------------------------------------------------------------------------------------------------------------
    // Dashboard
    // -------------------------------------------------------------------------------------------------------------
    public function dashboard(Request $request)
    {
        $sessionUser= $request->session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        //dd($user);
        $data = [
            'title' => 'Main Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        
        
        return view('content.dashboard', $data);
    }
        public function register(): View
    {
        return view ('register.register');
    }
        public function login(): View
    {
        return view ('login.login');
    }
       public function dashboardAdmin()
    {
        $data = [
            'title' => 'Admin Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard'
        ];
        return view('content.dashboardAdmin', $data);
    }
           public function dashboardSuperAdmin()
    {
        $data = [
            'title' => 'Super Admin Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard'
        ];
        return view('content.dashboardSuperAdmin', $data);
    }
      public function create(): View
    {
        $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        //dd($user);
        $data = [
            'title' => 'Main Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view ('content.create',$data);
    }
         
    public function check(string $id, Request $request): View
    {   
        $query = PermohonanModel::where('pemohon_id', $id);
        $sortBy = $request->get('sort_by', 'tgl_pengajuan');
           $sortOrder = $request->get('sort_order', 'desc');
        $allowedSortColumns = ['nama_item', 'kepentingan', 'tgl_pengajuan', 'tgl_selesai', 'est_biaya', 'akt_biaya', 'status'];
         if (in_array($sortBy, $allowedSortColumns)) {
            if ($sortBy === 'kepentingan') {
    $query->orderByRaw("
        CASE kepentingan
            WHEN 'Normal' THEN 1
            WHEN 'Mendesak' THEN 2
            WHEN 'Sangat Mendesak' THEN 3
        END $sortOrder
    ");
} else {
    $query->orderBy($sortBy, $sortOrder);
}
    
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('tgl_pengajuan', 'desc');
        }
        $permohonans = $query->paginate(10);
               $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        //dd($user);
        $data = [
            'title' => 'Main Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view ('content.check',$data, compact('permohonans', 'sortBy', 'sortOrder'));
    }
    
    public function show(Request $request): View
    {    
        $query = PermohonanModel::query();
        $sortBy = $request->get('sort_by', 'tgl_pengajuan');
           $sortOrder = $request->get('sort_order', 'desc');
        $allowedSortColumns = ['nama_item', 'kepentingan', 'tgl_pengajuan', 'tgl_selesai', 'est_biaya', 'akt_biaya', 'status'];
         if (in_array($sortBy, $allowedSortColumns)) {
            if ($sortBy === 'kepentingan') {
    $query->orderByRaw("
        CASE kepentingan
            WHEN 'Normal' THEN 1
            WHEN 'Mendesak' THEN 2
            WHEN 'Sangat Mendesak' THEN 3
        END $sortOrder
    ");
}else if($sortBy === 'status'){
    $query->orderByRaw("
        CASE status
            WHEN 'Approved' THEN 1
            WHEN 'Pending' THEN 2
            WHEN 'Rejected' THEN 3
        END $sortOrder
    ");
} else {
    $query->orderBy($sortBy, $sortOrder);
}

            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('tgl_pengajuan', 'desc');
        }
        $permohonans = $query->paginate(10);

        //$permohonans = PermohonanModel::get();
               $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        //dd($user);
        $data = [
            'title' => 'Main Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view('content.showApplication',$data, compact('permohonans', 'sortBy', 'sortOrder'));
    }

    public function showApproved(Request $request): View
    {    
        $query = PermohonanModel::query()->where('status', 'Approved');
        $sortBy = $request->get('sort_by', 'tgl_pengajuan');
           $sortOrder = $request->get('sort_order', 'desc');
        $allowedSortColumns = ['nama_item', 'kepentingan', 'tgl_pengajuan', 'tgl_selesai', 'est_biaya', 'akt_biaya', 'status'];
         if (in_array($sortBy, $allowedSortColumns)) {
            if ($sortBy === 'kepentingan') {
    $query->orderByRaw("
        CASE kepentingan
            WHEN 'Normal' THEN 1
            WHEN 'Mendesak' THEN 2
            WHEN 'Sangat Mendesak' THEN 3
        END $sortOrder
    ");
}else if($sortBy === 'status'){
    $query->orderByRaw("
        CASE status
            WHEN 'Approved' THEN 1
            WHEN 'Pending' THEN 2
            WHEN 'Rejected' THEN 3
        END $sortOrder
    ");
} else {
    $query->orderBy($sortBy, $sortOrder);
}

            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('tgl_pengajuan', 'desc');
        }
        $permohonans = $query->paginate(10);

               $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        //dd($user);
        $data = [
            'title' => 'Main Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view('content.showApproved',$data, compact('permohonans', 'sortBy', 'sortOrder'));
    }
}