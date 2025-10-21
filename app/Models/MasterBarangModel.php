<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBarangModel extends Model
{
    use HasFactory;
    protected $table = 'master_barang_models';
    protected $fillable = ['nama_barang', 'kode_barang'];
    public function permohonan()
{
    return $this->belongsToMany(PermohonanModel::class, 'permohonan_barangs', 'barang_id', 'permohonan_id');
}

}
