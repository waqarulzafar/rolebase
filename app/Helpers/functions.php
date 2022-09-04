<?php

use App\Models\User;

if (!function_exists('sitename')){
    function sitename(){
        return ['site_title'=>'Role Base System'];
    }
}
if (!function_exists('favicon')){
    function favicon(){
        return 'noimage';
    }
}
if (!function_exists('logo')){
    function logo(){
        return 'ok';
    }
}
if (!function_exists('checkrole')){
 function checkrole($roleid,$userid){
     $user = User::with('roles')->where('id','=',$userid)->first();
     foreach ($user->roles as $role){
         if ($roleid==$role->id){
             return true;
         }
     }
     return false;
 }
}
?>
