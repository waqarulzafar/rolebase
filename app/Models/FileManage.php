<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileManage extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function fileAssign(){
        return $this->belongsToMany(Role::class,FileAssign::class,'role_id','file_id');
    }
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
}
