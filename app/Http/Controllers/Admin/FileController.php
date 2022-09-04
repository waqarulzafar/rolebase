<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FileManageDataTableEditor;
use App\Http\Controllers\Controller;
use App\Models\FileManage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FileController extends Controller
{
    public function index(){
        return view('admin.file.index');
    }
    public function fetchFiles(){
        $role=FileManage::select('id','name','desc','file');
        return DataTables::of($role)->make(true);
    }
    public function storeFile(FileManageDataTableEditor $editor){
        return $editor->process(\request());
    }
}
