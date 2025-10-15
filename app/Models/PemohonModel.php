<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemohonModel extends Model
{
    use HasFactory;
        protected $fillable = [
            'fullname',
        'username',
        'dept_id',
        'role',
        'password',
    ];
    public function permohonanDiajukan()
    {
        return $this->hasMany(PermohonanModel::class, 'pemohon_id');
    }

    public function permohonanDitinjau()
    {
        return $this->hasMany(PermohonanModel::class, 'peninjau_id');
    }
    public function department()
    {
        return $this->belongsTo(DepartmentModel::class, 'dept_id', 'id');
    }
}