<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FileManageDataTableEditor;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FileAssign;
use App\Models\FileManage;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FileController extends Controller
{
    public function index(){
        $deparments=Department::select('id as value','name as label')->get();
        return view('admin.file.index',compact('deparments'));
    }
    public function fetchFiles(){
        $role=FileManage::select('id','name','desc','file','department_id')->with('department');
        return DataTables::of($role)
            ->editColumn('department_id',function($item){
                if ($item->department){
                    return $item->department->name;
                }else{
                    return "";
                }
            })->make(true);
    }
    public function storeFile(FileManageDataTableEditor $editor){
        return $editor->process(\request());
    }
    public function fileAssign($id){
        $role = Role::where('id',$id)->first();
        $files = FileManage::all();
        return view('admin.file.fileassign',compact('role','files'));
    }
    public function postFileAssign(Request $request){
//        dd($request->all());
//        $files=$request->get('files');
//        dd($request->get('files'));
        $files = $request->dt;
//        dd($files);
        $deleteFile=FileAssign::where('role_id',$request->role_id)->delete();
        foreach ($files as $file){
                if (isset($file['files'])) {
                    $data = new FileAssign();
                    $data->role_id = $request->role_id;
                    $data->file_id = $file['files'];
                    $data->access_type = $file['access_type'];
                    $data->save();
                }

        }
        return redirect('admin/user/role')->with(['message','File Assign Successfully']);
    }
}
