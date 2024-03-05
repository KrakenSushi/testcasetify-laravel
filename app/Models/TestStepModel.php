<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestStepModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_test_steps';
    public $timestamps = false;
    protected $primaryKey = 'step_id';
    protected $fillable = [
        'test_case_id',
        'project_id',
        'step_num',
        'test_step',
        'test_data',
        'expected_result',
        'actual_result',
        'status'
    ];
}
