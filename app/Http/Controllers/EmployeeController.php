<?php

namespace App\Http\Controllers;

use App\Models\FileAssign;
use App\Models\FileManage;

use App\Models\User;
use App\Notifications\FileNotification;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Notification;
class EmployeeController extends Controller
{
    public function files(Request $request){
        $files=FileManage::
        when($request->q!='',function($q){
            return $q->where('name','like','%'.\request('q').'%');
        })->paginate(20);

        return view('employee.emp-files',compact('files'));
    }
    public function viewFile($id){

        $file=FileManage::find($id);
        $user=User::whereHas('role',function ($q){
            $q->where('name','Admin');
        })->get();
        $fileUrl=url(Storage::url($file->file));
        Notification::send($user,new FileNotification(Auth::user()->name .' has  viewed or downloaded the file.',$fileUrl,Auth::user()));

        $permissions=FileAssign::where('role_id',Auth::user()->role->id)->where('file_id',$file->id)->get()->last();

        if ($permissions){
            if ($permissions->access_type=='view'|| $permissions->access_type=='both'){

                if ($file){


                    return response()->file('storage/'.$file->file);
                }
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }

        return "Access Denied";
    }
    public function download($id,Request $request){
        $file=FileManage::find($id);


        $user=User::whereHas('role',function ($q){
            $q->where('name','Admin');
        })->get();
        $fileUrl=url(Storage::url($file->file));
        Notification::send($user,new FileNotification(Auth::user()->name .' has  viewed or downloaded the file.',$fileUrl,Auth::user()));

        $permissions=FileAssign::where('role_id',Auth::user()->role->id)->where('file_id',$file->id)->get()->last();

        if ($permissions){
            if ($permissions->access_type=='download'|| $permissions->access_type=='both'){

                if ($file){


                    return response()->file('storage/'.$file->file);
                }
            }else{
                abort(403);
            }
        }else{
            abort(403);
        }
    }
}
