<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DepartmentDataTableEditor;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    public function index(){
        return view('admin.department');
    }
    public function fetchDepartment(){
        $role=Department::select('id','name','desc');
        return DataTables::of($role)->make(true);
    }
    public function storeDepartment(DepartmentDataTableEditor $editor){
        return $editor->process(\request());
    }
}
