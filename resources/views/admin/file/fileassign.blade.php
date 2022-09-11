@extends('mainpages.mainadmin')

@section('css')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/editor/css/editor.bootstrap4.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->

                        <h5 class="text-dark font-weight-bold my-1 mr-5">Assign File To Role</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Admin</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">File</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">File Assign</a>
                            </li>

                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->

                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-body">


                        <div style="text-align: right;" class="btn-group" id="dtButtons" role="group" aria-label="Button group with nested dropdown">
                        </div>
                        <div class="container">
                            <h3 align="center">File Assign</h3>
                            <form  enctype="multipart/form-data" method="POST"  action="{{ url('admin/file/post-file-assign') }}">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Role :</label>
                                            <div class="input-group">
                                                <input name="role" value="{{ $role->name }}" type="text" readonly class="form-control" placeholder="Role"/>
                                                <input name="role_id" value="{{ $role->id }}" type="hidden" class="form-control" placeholder="Role"/>
                                                <div class="input-group-append"><span class="input-group-text"><i class="la la-map-marker"></i></span></div>
                                            </div>
                                            <span class="form-text text-muted">Role Name</span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <td style="display: none">File Assign</td>
                                                        <th>File Name</th>
                                                        <th>File</th>
                                                        <th>Access Type</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($files as $key=>$file)
                                                        <tr>
                                                            <td style="display: none;"><input class="d-none" checked type="checkbox" {{ check_role($role->id,$file->id) }} name="dt[{{$key}}][files]" value="{{ $file->id }}" ></td>
                                                            <td>{{ $file->name }}</td>
                                                            <td><img src="{{ file_type($file->file)}}" height="90px" width="90px"></td>
                                                            <td><select class="form-control" name="dt[{{$key}}][access_type]">
                                                                    <option {{ check_select($role->id,$file->id,'view') }} value="view">View</option>
                                                                    <option {{ check_select($role->id,$file->id,'download') }} value="download">Download</option>
                                                                    <option {{ check_select($role->id,$file->id,'both') }} value="both">Both</option>
                                                                </select></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                                            <button type="reset" class="btn btn-secondary">Cancel</button>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <button type="reset" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!--begin: Datatable-->

                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@endsection

@section('js')

@endsection
