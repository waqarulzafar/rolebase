<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles(){
        return $this->belongsToMany(Role::class,RoleAssig::class,'user_id','role_id');
    }
    public function role(){
        return $this->hasOne(RoleAssig::class,'user_id');
    }
    public function hasAnyRole($roles){
        if(is_array($roles)){

            foreach($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
        }else{
            if($this->hasRole($roles)){
                return true;
            }
            return false;
        }


    }
    public function hasRole($role){

        if($this->roles()->where('name',$role)->first()){
            return true;
        }
        return false;
    }
    public function getPictureAttribute($value){
        if ($value){
            return url('uploads/'.$value);
        }
        return url('assets/media/users/300_21.jpg');
    }
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
}
