<?php

namespace App\Http\Controllers;

use App\Models\MasterStatusModel;
use App\Models\PemohonModel;
use App\Models\PermohonanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $userId = $user->id;
        // Statistics
    $totalApplications = PermohonanModel::where('pemohon_id', $userId)->count();
    $pending = PermohonanModel::where('pemohon_id', $userId)->where('status_id', 1)->count();
    $approved = PermohonanModel::where('pemohon_id', $userId)->where('status_id', 2)->count();
    $onProgress = PermohonanModel::where('pemohon_id', $userId)->where('status_id', 4)->count();
    $finished = PermohonanModel::where('pemohon_id', $userId)->where('status_id', 5)->count();
    $rejected = PermohonanModel::where('pemohon_id', $userId)->where('status_id', 3)->count();
    // Recent Applications (5 terbaru)
    $recentApplications = PermohonanModel::with(['status', 'jenis_permohonan', 'lokasi', 'barang'])
        ->where('pemohon_id', $userId)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    // Monthly Activity (6 bulan terakhir)
    $monthLabels = [];
    $monthData = [];
    for ($i = 5; $i >= 0; $i--) {
        $date = now()->subMonths($i);
        $monthLabels[] = $date->format('M');
        $monthData[] = PermohonanModel::where('pemohon_id', $userId)
            ->whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->count();
    }
    $data = [
            'title' => 'Main Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
    return view('content.dashboard',$data ,compact(
        'totalApplications', 'pending', 'approved', 'onProgress', 'finished',
        'recentApplications', 'monthLabels', 'monthData','rejected'
    ));
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
        // Statistics
    $pending = PermohonanModel::where('status_id', 1)->count();
    $approved = PermohonanModel::where('status_id', 2)->count();
    $onProgress = PermohonanModel::where('status_id', 4)->count();
    $finished = PermohonanModel::where('status_id', 5)->count();
    $rejected = PermohonanModel::where('status_id',3)->count();

    $sum = $pending+$approved+$onProgress+$finished+$rejected;
    
    // By Urgency
    $sangatMendesak = PermohonanModel::where('kepentingan', 'Sangat Mendesak')->count();
    $mendesak = PermohonanModel::where('kepentingan', 'Mendesak')->count();
    $normal = PermohonanModel::where('kepentingan', 'Normal')->count();
    
    // Recent Applications
    $recentApplications = PermohonanModel::with(['pemohon.department', 'status'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    $currentMonth = now()->month();
    // By Department
    $deptStats = PermohonanModel::join('pemohon_models', 'permohonan_models.pemohon_id', '=', 'pemohon_models.id')
        ->join('master_department_models', 'pemohon_models.dept_id', '=', 'master_department_models.id')
        ->select('master_department_models.dept_code', DB::raw('count(*) as total'))
        ->groupBy('master_department_models.dept_code')
        ->get();
    
    $deptLabels = $deptStats->pluck('dept_code');
    $deptData = $deptStats->pluck('total');
    
    // By Status
    $statusData = [
        PermohonanModel::where('status_id', 1)->count(), // Pending
        PermohonanModel::where('status_id', 2)->count(), // Approved
        PermohonanModel::where('status_id', 4)->count(), // On Progress
        PermohonanModel::where('status_id', 5)->count(),// Finished
        PermohonanModel::where('status_id', 3)->count(), // Rejected 
    ];
    
    // Monthly Trend (6 bulan terakhir)
    $monthLabels = [];
    $monthData = [];
    for ($i = 11; $i >= 0; $i--) {
        $date = now()->subMonths($i);
        $monthLabels[] = $date->format('M');
        $monthData[] = PermohonanModel::whereYear('created_at', $date->year)
            ->whereMonth('created_at', $date->month)
            ->count();
    }
    
    // Top Requested Items
    $topItems = DB::table('permohonan_barangs')
        ->join('master_barang_models', 'permohonan_barangs.barang_id', '=', 'master_barang_models.id')
        ->select('master_barang_models.nama_barang', 'master_barang_models.kode_barang', DB::raw('SUM(permohonan_barangs.jumlah) as total_requests'))
        ->groupBy('master_barang_models.id', 'master_barang_models.nama_barang', 'master_barang_models.kode_barang')
        ->orderBy('total_requests', 'desc')
        ->take(5)
        ->get();
        $data = [
            'title' => 'Admin Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard'
        ];
        return view('content.dashboardAdmin', $data,compact(
        'pending', 'approved', 'onProgress', 'finished','rejected',
        'sangatMendesak', 'mendesak', 'normal',
        'recentApplications', 'deptLabels', 'deptData',
        'statusData', 'monthLabels', 'monthData', 'topItems','sum'
    ));
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
        
        $data = [
            'title' => 'Main Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view ('content.create',$data);
    }
         
    public function check(string $id): View
    {   
        $query = PermohonanModel::where('pemohon_id', $id);
        
       
        $permohonans = $query->with(['status','lokasi','barang','jenis_permohonan','peninjau'])->paginate(10);
        $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();

        $data = [
            'title' => 'Main Dashboard | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view ('content.check',$data, compact('permohonans'));
    }
    public function showAll(): View
    {    
        $permohonans = PermohonanModel::with([
            'status',
            'lokasi',
            'barang',
            'jenis_permohonan',
            'peninjau',
            'pemohon.department' // Load department juga
        ])->get();

        
        $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        
        $data = [
            'title' => 'Available Application | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view('content.showAllApplication',$data, compact('permohonans'));
    }
    public function show(): View
    {    
        $permohonans = PermohonanModel::where('status_id', 1)->with([
            'status',
            'lokasi',
            'barang',
            'jenis_permohonan',
            'peninjau',
            'pemohon.department' // Load department juga
        ])->get();

        
        $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        
        $data = [
            'title' => 'Available Application | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view('content.showApplication',$data, compact('permohonans'));
    }

    public function showApproved(): View
    {    
        $permohonans = PermohonanModel::whereIn('status_id', [2, 4])
            ->with([
                'status',
                'lokasi',
                'barang',
                'jenis_permohonan',
                'peninjau',
                'pemohon.department'
            ])
            ->get();
               $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        
        $data = [
            'title' => 'Approved Application | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view('content.showApproved',$data, compact('permohonans'));
    }
    public function showFinished(): View
    {    
         $permohonans = PermohonanModel::where('status_id', 5  )->with([
            'status',
            'lokasi',
            'barang',
            'jenis_permohonan',
            'peninjau',
            'pemohon.department' 
        ])->get();
        $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        
        $data = [
            'title' => 'Finished Application | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view('content.showFinished',$data, compact('permohonans'));
    }
    public function printOut( $id): View
    {   
        $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        $permohonan = PermohonanModel::with(['barang', 'pemohon','lokasi','status'])->findOrFail($id);
        $data = [
            'title' => 'Print Out | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view('content.print',$data, compact('permohonan'));    
    }

     public function printOutISO( $id): View
    {   
        $sessionUser= session()->get('user');
        $user = PemohonModel::with('department')->where('id', $sessionUser['id'])->first();
        $permohonan = PermohonanModel::with(['barang', 'pemohon','lokasi','status'])->findOrFail($id);
        $data = [
            'title' => 'Print Out ISO Form | GI-GOF',
            'menu' => 'Content',
            'sub_menu' => 'Dashboard',
            'user' => $user,
        ];
        return view('content.printISO',$data, compact('permohonan'));    
    }
}