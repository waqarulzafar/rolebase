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
if (!function_exists('file_type')){
    function file_type($file){
        $extention=\Illuminate\Support\Facades\File::extension($file);
//        dump($extention);
        if ($extention=='pdf'){
            return url('icons/pdf.png');
        }elseif ($extention=='jpg' || $extention=='png'){
            return url('/icons/image.png');
        }elseif ($extention=='docx' || $extention=='doc'){
            return url('/icons/word.png');
        }elseif ($extention=='mp4'){
            return url('icons/video.png');
        }else {
            return url('/icons/other.png');
        }
    }
}
if (!function_exists('check_role')){
    function check_role($roleid,$file_id){
        $check=\App\Models\FileAssign::where('role_id',$roleid)->where('file_id',$file_id)->get()->last();
        if ($check){
            return 'checked';
        }
        return "";
    }
}
if (!function_exists('check_select')){
    function check_select($roleid,$file_id,$type='view'){
        $check=\App\Models\FileAssign::where('role_id',$roleid)
            ->where('file_id',$file_id)
           ->where('access_type',$type)->get()->last();
        if ($check){
            return 'selected';
        }
        return "";
    }
}
if (!function_exists('user_notification')){
    function user_notification()
    {
        if (auth()->user()) {
            return auth()->user()->unreadNotifications;
        }else{
            return [];
        }
        }
    }

?>
