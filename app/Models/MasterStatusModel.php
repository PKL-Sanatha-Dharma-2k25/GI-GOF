<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterStatusModel extends Model
{
    protected $table = 'master_status_models';
    protected $fillable = ['nama_status'];
}
