<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;


     protected $table = 'tbl_projects';
    public $timestamps = false;
    protected $primaryKey = 'project_id';
    protected $fillable = [
        'project_id',
        'project_name',
        'project_owner',
        'project_members',
        'project_desc',
        'status',
        'last_access',
    ];
}
