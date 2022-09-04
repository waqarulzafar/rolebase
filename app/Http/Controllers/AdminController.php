<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Department;
use App\Models\FileManage;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function dashboard(Request $request){
        $user = User::all()->count();
        $role = Role::all()->count();
        $file = FileManage::all()->count();
        $depart = Department::all()->count();
        return view('admin.index',compact('user','role','file','depart'));
    }
}
