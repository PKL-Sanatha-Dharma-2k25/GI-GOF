<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanModel extends Model
{
    Protected $table = 'permohonan_models';
    use HasFactory;
        protected $attributes = [
        'alasan' => 'Pending',
    ];
        protected $fillable = [
        'nama_item',
        'kode_item',
        'tgl_pengajuan',
        'tgl_selesai',
        'status',
        'alasan',
        'est_biaya',
        'akt_biaya',
        'foto_item_sebelum',
        'foto_item_sesudah',
        'pemohon_id',
        'peninjau_id',
        'kepentingan',
    ];
        public function pemohon()
    {
        return $this->belongsTo(PemohonModel::class, 'pemohon_id');
    }
        public function peninjau()
    {
        return $this->belongsTo(PemohonModel::class, 'peninjau_id');
    }
}
