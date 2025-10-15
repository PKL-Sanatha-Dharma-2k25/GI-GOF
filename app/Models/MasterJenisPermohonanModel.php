<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterJenisPermohonanModel extends Model
{
    protected $table = 'master_jenis_permohonan_models';
    protected $fillable = ['nama_jenis_permohonan'];
}
