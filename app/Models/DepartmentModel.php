<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    protected $table = 'master_department_models';
    protected $fillable = [
        'dept_name',
        'dept_code',
    ];
}
