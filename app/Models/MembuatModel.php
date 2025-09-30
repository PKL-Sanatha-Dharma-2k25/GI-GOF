<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembuatModel extends Model
{
    protected $table = 'membuat_models';
    protected $fillable = [
        'kode_item',
        'nama_item',
        'tgl_pengajuan',
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
}
