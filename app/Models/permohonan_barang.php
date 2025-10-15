<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permohonan_barang extends Model
{
     use HasFactory;

    protected $table = 'permohonan_barangs';

    protected $fillable = [
        'permohonan_id',
        'barang_id',
        'jumlah',
        'keterangan',
    ];
}
