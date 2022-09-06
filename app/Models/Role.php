<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function files(){
        return $this->belongsToMany(FileAssign::class,FileManage::class,'role_id','file_id');
    }
}
