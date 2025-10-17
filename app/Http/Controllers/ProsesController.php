<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\PemohonModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\MasterBarangModel;
use App\Models\MasterJenisPermohonanModel;
use App\Models\MasterLokasiModel;
use App\Models\MasterStatusModel;
use App\Models\permohonan_barang;
use App\Models\PermohonanModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Log;
use Laravel\Pail\ValueObjects\Origin\Console;
use Illuminate\Support\Facades\DB;

class ProsesController extends Controller
{
        public function index(): View
    {
        return view('content.create');
    }

        public function simpanPermohonan(Request $request): RedirectResponse 
{
    $user = PemohonModel::with('department')->find(session('user.id'));
    
    $request->validate([
        'kepentingan' => ['required','string', 'max:255'],
        'alasan_permohonan' => ['required','string', 'max:255'],
        'file_upload' => ['required','image','mimes:jpeg,jpg,png,webp', 'max:10240'],
    ]);
    
    DB::beginTransaction();
    try {
        $year = now()->year;
        $deptId = $user->dept_id;
        
        
        $lastPermohonan = PermohonanModel::whereYear('permohonan_models.created_at', $year)
            ->join('pemohon_models', 'permohonan_models.pemohon_id', '=', 'pemohon_models.id')
            ->where('pemohon_models.dept_id', $deptId)
            ->lockForUpdate() 
            ->orderBy('permohonan_models.created_at', 'desc')
            ->select('permohonan_models.*') 
            ->first();
        $counter = $lastPermohonan ? 
            (int)substr($lastPermohonan->no_permohonan, -4) + 1 : 1;
        
        $counter = str_pad($counter, 4, '0', STR_PAD_LEFT);
        $no_permohonan = $user->department->dept_code . '-' . $year . '-' . $counter;
        
        // Upload file
        $lokasi = MasterLokasiModel::where('nama_lokasi', $request->lokasi)->first();
        $image = $request->file('file_upload');
        $path = $image->storeAs('permohonans', $image->hashName(), 'public');
        $jenis = MasterJenisPermohonanModel::where('nama_jenis_permohonan', $request->jenis_permohonan)->first();
        
        
        // Simpan permohonan
        $data = PermohonanModel::create([
            'no_permohonan' => $no_permohonan,
            'kepentingan' => $request->kepentingan,
            'alasan_permohonan' => $request->alasan_permohonan,
            'foto_sebelum' => $path,
            'pemohon_id' => session('user.id'),
            'jenis_permohonan_id' => $jenis->id,
            'lokasi_id' => $lokasi->id,
            'status_id' => 1,
        ]);
        
        // Attach barang
        $barang_ids = $request->barang_id;
        $jumlah = $request->jumlah_barang;

        foreach ($barang_ids as $index => $barang_id) {
            $data->barang()->attach($barang_id, [
                'jumlah' => $jumlah[$index] ?? 1,
                'keterangan' => null,
            ]);
        }
        
        DB::commit(); 
        return redirect()->back()->with('success', 'Permohonan telah dibuat.');
        
    } catch (\Exception $e) {
        DB::rollBack(); // Jika error, batalkan semua perubahan
        dd($e->getMessage(), $e->getTrace());
    }
}
    public function getNamaBarang(){
        $data = MasterBarangModel::get(['id','nama_barang','kode_barang']);
        return response()->json([
            'data' => $data
        ]);
    }
       public function getJenisPermohonan(){
        $data = MasterJenisPermohonanModel::get(['nama_jenis_permohonan']);
        return response()->json([
            'data' => $data
        ]);
    }

    public function getLokasiKendala(){
        $data = MasterLokasiModel::get(['nama_lokasi']);
        return response()->json([
            'data' => $data
        ]);
    }

    public function addMasterLokasi(Request $request){
       
        $request->validate([
            'nama_lokasi' => ['required', 'string', 'max:255', 'unique:master_lokasi_models,nama_lokasi'],
        ]);
         $nama = ucfirst(strtolower($request->nama_lokasi));
        $data = MasterLokasiModel::create([
            'nama_lokasi' => $nama,
        ]);
        return response()->json([
            'id' => $data->id,
            'nama_lokasi' => $data->nama_lokasi,
        ]);
    }
      public function addMasterBarang(Request $request)
{
    try {
        $request->validate([
            'nama_barang' => ['required', 'string', 'max:255', 'unique:master_barang_models,nama_barang'],
        ]);
        
        $nama = ucfirst(strtolower($request->nama_barang));
        $prefix = strtoupper(substr($nama, 0, 3));
    
    // Cari kode terakhir dengan prefix yang sama
    $lastBarang = MasterBarangModel::where('kode_barang', 'LIKE', $prefix . '%')
        ->orderBy('kode_barang', 'desc')
        ->first();
        if($lastBarang){
            $kode = strtoupper(substr($nama,0,3) .'1');
            preg_match('/\d+$/', $lastBarang->kode_barang, $matches);
        $lastNumber = isset($matches[0]) ? intval($matches[0]) : 0;
        $newNumber = $lastNumber + 1;
        $kode = $prefix . $newNumber;
    } else {
        // Jika belum ada, mulai dari 1
        $kode = $prefix . '1';
    }
        
        $data = MasterBarangModel::create([
            'nama_barang' => $nama,
            'kode_barang' => $kode,
        ]);
        
        return response()->json([
            'id' => $data->id,
            'nama_barang' => $data->nama_barang,
            'kode_barang' => $data->kode_barang,
        ], 201);
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'error' => 'Barang sudah ada atau data tidak valid',
            'details' => $e->errors()
        ], 422);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Gagal menyimpan barang',
            'message' => $e->getMessage()
        ], 500);
    }
}
    
    public function detail($id)
{
    try {
        $permohonan = PermohonanModel::with([
            'barang',
            'status',
            'lokasi',
            'jenis_permohonan',
            'pemohon.department'
        ])->findOrFail($id);

        // Format dates dengan null check
        $created_at = $permohonan->created_at 
            ? \Carbon\Carbon::parse($permohonan->created_at)->format('M d, Y H:i') 
            : '-';
            
        $approved_at = $permohonan->approved_at 
            ? \Carbon\Carbon::parse($permohonan->approved_at)->format('M d, Y H:i') 
            : '-';
            
        $onProg_at = $permohonan->on_progress_at 
            ? \Carbon\Carbon::parse($permohonan->on_progress_at)->format('M d, Y H:i') 
            : '-';
            
        $finished_at = $permohonan->finished_at 
            ? \Carbon\Carbon::parse($permohonan->finished_at)->format('M d, Y H:i') 
            : '-';

        return response()->json([
            'id' => $permohonan->id,
            'no_permohonan' => $permohonan->no_permohonan ?? '-',
            'kepentingan' => $permohonan->kepentingan ?? '-',
            'alasan_permohonan' => $permohonan->alasan_permohonan ?? '-',
            'status' => $permohonan->status->nama_status ?? '-',
            'tgl_pengajuan' => $permohonan->tgl_pengajuan ?? '-',
            'tgl_selesai' => $permohonan->tgl_selesai ?? '-',
            'foto_sebelum' => $permohonan->foto_sebelum ?? '',
            'foto_sesudah' => $permohonan->foto_sesudah ?? '',
            'finished_at' => $finished_at,
            'on_progress_at' => $onProg_at,
            'created_at' => $created_at,
            'approved_at' => $approved_at,
            
            
            'barang' => $permohonan->barang->map(function($item) {
                return [
                    'nama_barang' => $item->nama_barang,
                    'jumlah' => $item->pivot->jumlah ?? 0,
                    'keterangan' => $item->pivot->keterangan_barang ?? '-'
                ];
            }),
            
            // Helper fields
            'nama_barang_text' => $permohonan->barang->pluck('nama_barang')->join(', '),
            'jumlah_barang_total' => $permohonan->barang->sum(function($item) {
                return $item->pivot->jumlah ?? 0;
            }),
            
            'lokasi' => $permohonan->lokasi->nama_lokasi ?? '-',
            'username' => $permohonan->pemohon->username ?? '-',
        ]);
        
    } catch (\Exception $e) {
        Log::error('Error in detail method: ' . $e->getMessage());
        return response()->json([
            'error' => 'Failed to load application details',
            'message' => $e->getMessage()
        ], 500);
    }
}
public function delete(String $id){
$permohonan = PermohonanModel::find($id);

    if (!$permohonan) {
        return response()->json(['message' => 'Data tidak ditemukan','success' => false], 404);
    }
 
    $permohonan->delete();

    return response()->json(['message' => 'Data berhasil dihapus', 'success' => true]);
}
public function approve(Request $request)
{ 
    $approved_at = now();
    $permohonan = PermohonanModel::find($request->id);
    if ($permohonan) {
        $permohonan->approved_at = $approved_at;
        $permohonan->status_id = 2; // '2' for 'Approved' status
        $permohonan->peninjau_id = $request->peninjau_id;
        $permohonan->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 404);
}

public function getAppData(Request $request){

    $permohonan = PermohonanModel::whereYear('permohonan_models.created_at', $request->year)
        ->whereMonth('permohonan_models.created_at', $request->month)
        ->get();
    
    $pending = $permohonan->where('status_id', 1)->count();
    $approved = $permohonan->where('status_id', 2)->count();
    $rejected = $permohonan->where('status_id', 3)->count();
    $onProg = $permohonan->where('status_id', 4)->count();
    $finished = $permohonan->where('status_id', 5)->count();
    $sum = $pending + $approved + $rejected + $onProg + $finished;
    
    // Data chart departments
    $deptStats = PermohonanModel::join('pemohon_models', 'permohonan_models.pemohon_id', '=', 'pemohon_models.id')
        ->join('master_department_models', 'pemohon_models.dept_id', '=', 'master_department_models.id')
        ->whereYear('permohonan_models.created_at', $request->year)
        ->whereMonth('permohonan_models.created_at', $request->month)
        ->select('master_department_models.dept_code', DB::raw('count(*) as total'))
        ->groupBy('master_department_models.dept_code')
        ->get();
    
    $statusData = [
        $permohonan->where('status_id', 1)->count(),
        $permohonan->where('status_id', 2)->count(),
        $permohonan->where('status_id', 4)->count(),
        $permohonan->where('status_id', 5)->count(),
        $permohonan->where('status_id', 3)->count(),
    ];
    
  
    return response()->json([
        'pending' => $pending,
        'approved' => $approved,
        'rejected' => $rejected,
        'onProgress' => $onProg,
        'finished' => $finished,
        'sum' => $sum,
        'deptLabels' => $deptStats->pluck('dept_code'),
        'deptData' => $deptStats->pluck('total'),
        'statusData' => $statusData,
    ]);
}

public function getTableData(Request $request)
{
    $month = $request->input('month');
    $year = $request->input('year');
    $referer = $request->headers->get('referer');
    $page = basename(parse_url($referer, PHP_URL_PATH));

    if($page === 'show'){
$data = PermohonanModel::with([
        'barang',
        'status',
        'pemohon',
        'lokasi',
        'jenis_permohonan'
    ])
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->whereIn('status_id', [1])
    ->get()
    ->map(function($item) {
        return [
            'id' => $item->id,
            'no_permohonan' => $item->no_permohonan,
            'barang' => $item->barang->map(function($b) {
                return [
                    'nama_barang' => $b->nama_barang,
                    'jumlah' => $b->pivot->jumlah ?? 0
                ];
            })->toArray(),
            'kepentingan' => $item->kepentingan,
            'jenis_permohonan' => [
                'nama_jenis_permohonan' => $item->jenis_permohonan->nama_jenis_permohonan ?? '-'
            ],
            'lokasi' => [
                'nama_lokasi' => $item->lokasi->nama_lokasi ?? '-'
            ],
            'created_at' => $item->created_at,
            'status' => [
                'nama_status' => $item->status->nama_status ?? 'Pending'
            ],
            'pemohon' => [
                'username' => $item->pemohon->username ?? '-'
            ]
        ];
    });
    }
    else if ($page === 'showApproved'){
        $data = PermohonanModel::with([
        'barang',
        'status',
        'pemohon',
        'lokasi',
        'jenis_permohonan'
    ])
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->whereIn('status_id', [2,4])
    ->get()
    ->map(function($item) {
        return [
            'id' => $item->id,
            'no_permohonan' => $item->no_permohonan,
            'barang' => $item->barang->map(function($b) {
                return [
                    'nama_barang' => $b->nama_barang,
                    'jumlah' => $b->pivot->jumlah ?? 0
                ];
            })->toArray(),
            'kepentingan' => $item->kepentingan,
            'jenis_permohonan' => [
                'nama_jenis_permohonan' => $item->jenis_permohonan->nama_jenis_permohonan ?? '-'
            ],
            'lokasi' => [
                'nama_lokasi' => $item->lokasi->nama_lokasi ?? '-'
            ],
            'created_at' => $item->created_at,
            'status' => [
                'nama_status' => $item->status->nama_status ?? 'Pending'
            ],
            'pemohon' => [
                'username' => $item->pemohon->username ?? '-'
            ]
        ];
    });
    }else if ($page === 'showFinished'){
        $data = PermohonanModel::with([
        'barang',
        'status',
        'pemohon',
        'lokasi',
        'jenis_permohonan'
    ])
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->whereIn('status_id', [5])
    ->get()
    ->map(function($item) {
        return [
            'id' => $item->id,
            'no_permohonan' => $item->no_permohonan,
            'barang' => $item->barang->map(function($b) {
                return [
                    'nama_barang' => $b->nama_barang,
                    'jumlah' => $b->pivot->jumlah ?? 0
                ];
            })->toArray(),
            'kepentingan' => $item->kepentingan,
            'jenis_permohonan' => [
                'nama_jenis_permohonan' => $item->jenis_permohonan->nama_jenis_permohonan ?? '-'
            ],
            'lokasi' => [
                'nama_lokasi' => $item->lokasi->nama_lokasi ?? '-'
            ],
            'created_at' => $item->created_at,
            'status' => [
                'nama_status' => $item->status->nama_status ?? 'Pending'
            ],
            'pemohon' => [
                'username' => $item->pemohon->username ?? '-'
            ]
        ];
    });
    }
    else if ($page === 'showRejected'){
        $data = PermohonanModel::with([
        'barang',
        'status',
        'pemohon',
        'lokasi',
        'jenis_permohonan'
    ])
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->whereIn('status_id', [3])
    ->get()
    ->map(function($item) {
        return [
            'id' => $item->id,
            'no_permohonan' => $item->no_permohonan,
            'barang' => $item->barang->map(function($b) {
                return [
                    'nama_barang' => $b->nama_barang,
                    'jumlah' => $b->pivot->jumlah ?? 0
                ];
            })->toArray(),
            'kepentingan' => $item->kepentingan,
            'jenis_permohonan' => [
                'nama_jenis_permohonan' => $item->jenis_permohonan->nama_jenis_permohonan ?? '-'
            ],
            'lokasi' => [
                'nama_lokasi' => $item->lokasi->nama_lokasi ?? '-'
            ],
            'created_at' => $item->created_at,
            'status' => [
                'nama_status' => $item->status->nama_status ?? 'Pending'
            ],
            'pemohon' => [
                'username' => $item->pemohon->username ?? '-'
            ]
        ];
    });
    }
    else if($page === 'showAll'){
        $data = PermohonanModel::with([
        'barang',
        'status',
        'pemohon',
        'lokasi',
        'jenis_permohonan'
    ])
    ->whereYear('created_at', $year)
    ->whereMonth('created_at', $month)
    ->get()
    ->map(function($item) {
        return [
            'id' => $item->id,
            'no_permohonan' => $item->no_permohonan,
            'barang' => $item->barang->map(function($b) {
                return [
                    'nama_barang' => $b->nama_barang,
                    'jumlah' => $b->pivot->jumlah ?? 0
                ];
            })->toArray(),
            'kepentingan' => $item->kepentingan,
            'jenis_permohonan' => [
                'nama_jenis_permohonan' => $item->jenis_permohonan->nama_jenis_permohonan ?? '-'
            ],
            'lokasi' => [
                'nama_lokasi' => $item->lokasi->nama_lokasi ?? '-'
            ],
            'created_at' => $item->created_at,
            'status' => [
                'nama_status' => $item->status->nama_status ?? 'Pending'
            ],
            'pemohon' => [
                'username' => $item->pemohon->username ?? '-'
            ]
        ];
    });
    }
    
    
    return response()->json($data);
}

public function reject(Request $request)
{
    $rejected_at = now();
    $permohonan = PermohonanModel::find($request->id);
    if ($permohonan) {
        $permohonan->rejected_at = $rejected_at;
        $permohonan->status_id = $request->status_id;
        $permohonan->peninjau_id = $request->peninjau_id;
        $permohonan->catatan_peninjau = $request->catatan_peninjau;
        $permohonan->save();

        return redirect()->back()->with('success', 'Application Rejected.');
    }

        return redirect()->back()->with('error', 'Application not found.');

}

public function updateOnProgress(Request $request)
{
    $on_progress_at = now();
    $est_biaya  = $request->est_biaya;
    $clean_est_biaya = preg_replace("/[a-zA-Z]/", "", $est_biaya);
    $permohonan = PermohonanModel::find($request->id);
    if ($permohonan) {
        $permohonan->on_progress_at = $on_progress_at;
        $permohonan->status_id = $request->status_id;
        $permohonan->est_biaya = $clean_est_biaya;
        $permohonan->est_pengerjaan = $request->est_pengerjaan;
        $permohonan->save();
        return redirect()->back()->with('success', 'Application On Progress.');
    }
        return redirect()->back()->with('error', 'Application not found.');
}

public function cancelApplication(Request $request)
{
    $cancelled_at = now();
    $permohonan = PermohonanModel::find($request->id);
    if ($permohonan) {
        $permohonan->cancelled_at = $cancelled_at;
        $permohonan->status_id = $request->status_id;
        $permohonan->catatan_pemohon = $request->catatan_pemohon;
        $permohonan->save();

        return redirect()->back()->with('success', 'Application Cancelled.');
    }
        return redirect()->back()->with('error', 'Application not found.');
}

public function finished(Request $request)
{
    $finished_at = now();
    $akt_biaya  = $request->akt_biaya;
    $clean_akt_biaya = preg_replace("/[a-zA-Z]/", "", $akt_biaya);
    $image = $request->file('file_upload');
    $path = $image->storeAs('permohonans', $image->hashName(), 'public');
            $request->validate([
            'file_upload' => ['required','image','mimes:jpeg,jpg,png,webp', 'max:10240'],
        ]);
        
    $permohonan = PermohonanModel::find($request->id);
    if ($permohonan) {
        $permohonan->finished_at = $finished_at;
        $permohonan->status_id = $request->status_id;
        $permohonan->akt_biaya = $clean_akt_biaya;
        $permohonan->foto_sesudah =$path;
        $permohonan->save();
        return redirect()->back()->with('success', 'Application Finished.');
    }
        return redirect()->back()->with('error', 'Application not found.');

}

}