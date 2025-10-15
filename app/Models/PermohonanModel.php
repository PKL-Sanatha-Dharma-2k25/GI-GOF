<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanModel extends Model
{
    Protected $table = 'permohonan_models';
    use HasFactory;
        protected $fillable = [
        'no_permohonan',
        'kode_barang',
        'tgl_pengajuan',
        'tgl_selesai',
        'status_id',
        'alasan_permohonan',
        'est_biaya',
        'akt_biaya',
        'jumlah_barang',
        'lokasi_id',
        'jenis_permohonan_id',
        'foto_sebelum',
        'foto_sesudah',
        'pemohon_id',
        'peninjau_id',
        'kepentingan',
        'catatan_peninjau',
        'foto_bukti_pembayaran',
        'dept_id'
    
    ];
        public function pemohon()
    {
        return $this->belongsTo(PemohonModel::class, 'pemohon_id','id');
    }
        public function peninjau()
    {
        return $this->belongsTo(PemohonModel::class, 'peninjau_id','id');
    }
        public function lokasi()
    {
        return $this->belongsTo(MasterLokasiModel::class, 'lokasi_id', 'id');
    }
        public function status()
    {
        return $this->belongsTo(MasterStatusModel::class, 'status_id', 'id');
    }
        public function jenis_permohonan()
    {
        return $this->belongsTo(MasterJenisPermohonanModel::class, 'jenis_permohonan_id', 'id');
    }
    public function barang()
{
    return $this->belongsToMany(MasterBarangModel::class, 'permohonan_barangs', 'permohonan_id', 'barang_id')
                ->withPivot('jumlah', 'keterangan')
                ->withTimestamps();
}

}
