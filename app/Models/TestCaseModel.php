<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCaseModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_test_cases';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'project_id',
        'tc_title',
        'tc_num',
        'tc_des_by',
        'tc_priority',
        'tc_des_date',
        'tc_module_name',
        'tc_exec_by',
        'tc_desc',
        'tc_exec_date',
        'tc_precon',
        'tc_postcon'
    ];
}
