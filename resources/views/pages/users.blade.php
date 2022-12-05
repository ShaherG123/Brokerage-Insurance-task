@extends('imports.app')
@section('content')
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="mt-0 header-title">Users
                            <button type="button" onclick="showModal()" class="btn btn-general-style btn-rounded width-md waves-effect waves-light btn-add-new">
                                <i class="mdi mdi-plus-circle-outline"></i>New user</button>
                        </h4>
                        <p class="text-muted font-14 mb-3">
                            You can add new , edit or delete user.
                        </p>
                        <table id="users-table" class="table table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>email</th>
                                    <th>type</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

<!-- Long Content Scroll Modal -->
<div class="modal fade" id="add-model-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-2">
                                        <form autocomplete="off" class="form-horizontal" id="formInputs" role="form">
                                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token()}}">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label modal-label" for="example-date">Name</label>
                                                <div class="col-md-10">
                                                    <input autocomplete="off" id="name" class="form-control">
                                                    <p class="error_validation" id="P_name" style="display:none; color: red; margin-bottom: 0pxd; margin-bottom: 0px"></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label modal-label" for="example-date">Email</label>
                                                <div class="col-md-10">
                                                    <input autocomplete="off" id="email" class="form-control">
                                                    <p class="error_validation" id="P_email" style="display:none; color: red; margin-bottom: 0pxd; margin-bottom: 0px"></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label modal-label" for="example-textarea">Type</label>
                                                <div class="col-md-10">
                                                    <select id="type" class="form-control select2">
                                                        <option value="admin">Admin</option>
                                                        <option value="employee">Employee</option>
                                                    </select>
                                                    <p class="error_validation" id="P_type" style="display:none; color: red; margin-bottom: 0pxd; margin-bottom: 0px"></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label modal-label" for="example-date">Password</label>
                                                <div class="col-md-10">
                                                    <input autocomplete="off" type='password' id="password" class="form-control">
                                                    <p class="error_validation" id="P_password" style="display:none; color: red; margin-bottom: 0pxd; margin-bottom: 0px"></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label modal-label" for="example-date">Confirm password</label>
                                                <div class="col-md-10">
                                                    <input autocomplete="off" type='password' id="password_confirmation" class="form-control">
                                                    <p class="error_validation" id="P_password_confirmation" style="display:none; color: red; margin-bottom: 0pxd; margin-bottom: 0px"></p>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-general-style" id="addButtonUser" onclick="addUser()">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-sm" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="D_id" name="id">
                <h4 class="modal-title" id="mySmallModalLabel">Delete user</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="deleteUser()">Delete</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

<div class="modal fade" id="edit-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollableTitle">Users</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-12">
                                    <div class="p-2">
                                        <form autocomplete="off" class="form-horizontal" id="formInputs" role="form">
                                            <input type="hidden" id="_token" name="_token" value="{{ csrf_token()}}">
                                            <input type="hidden" id="E_id" name="id">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label modal-label" for="example-date">Name</label>
                                                <div class="col-md-10">
                                                    <input autocomplete="off" id="E_name" class="form-control">
                                                    <p class="error_validation" id="P_E_name" style="display:none; color: red; margin-bottom: 0pxd; margin-bottom: 0px"></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label modal-label" for="example-date">email</label>
                                                <div class="col-md-10">
                                                    <input autocomplete="off" id="E_email" class="form-control">
                                                    <p class="error_validation" id="P_E_email" style="display:none; color: red; margin-bottom: 0pxd; margin-bottom: 0px"></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label modal-label" for="example-textarea">Type</label>
                                                <div class="col-md-10">
                                                    <select id="E_type" class="form-control select2">
                                                        <option value="admin">Admin</option>
                                                        <option value="employee">Employee</option>
                                                    </select>
                                                    <p class="error_validation" id="E_P_type" style="display:none; color: red; margin-bottom: 0pxd; margin-bottom: 0px"></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label modal-label" for="example-date">Password</label>
                                                <div class="col-md-10">
                                                    <input autocomplete="off" type='password' id="E_password" class="form-control">
                                                    <p class="error_validation" id="E_P_password" style="display:none; color: red; margin-bottom: 0pxd; margin-bottom: 0px"></p>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label modal-label" for="example-date">Confirm password</label>
                                                <div class="col-md-10">
                                                    <input autocomplete="off" type='password' id="E_password_confirmation" class="form-control">
                                                    <p class="error_validation" id="E_P_password_confirmation" style="display:none; color: red; margin-bottom: 0pxd; margin-bottom: 0px"></p>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-general-style" id="editButtonUser" onclick="editUser()">Save</button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection