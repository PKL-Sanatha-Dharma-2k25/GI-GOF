<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterLokasiModel extends Model
{
    protected $table = 'master_lokasi_models';
    protected $fillable = ['nama_lokasi'];
}
