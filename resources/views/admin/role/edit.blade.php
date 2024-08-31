@extends('admin.admin_master')
@section('admin')
<!-- Content Header (Page header) -->
{{-- <section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <a href="{{ URL::previous() }}"  class="btn btn-danger mb-5">Back</a>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Role Edit</li>
        </ol>
      </div>
    </div>
    </div><!-- /.container-fluid -->
  </section> --}}
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><a href="{{ URL::previous() }}"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 30px;"></i></a>   Role Edit Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('role.update',$role->id) }}" id="roleAddForm">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Role Name<span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}">
                      <span class="text-danger">@error('name'){{$message}}@enderror</span>
                    </div>

                    </div>
                </div><!-- row -->



                                          </div>
                                          <!-- /.card-body -->
                                          <div class="card-footer">
                                            <input type="submit" class="btn btn-danger" value="Update" >
                                          </div>
                                        </form>
                                      </div>
                                      <!-- /.card -->
                                      <div class="card card-primary">
                                        <div class="card-header">
                                          <h3 class="card-title">Permission Assign Role</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->

                                        <form method="post" action="{{ route('role.permission.update',$role->id) }}" >
                                          @csrf
                                          <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if ($role->permissions)
                                                    @foreach ($role->permissions as $role_permission)

                                                        <a href="{{ route('roles.permissions.revoke', [$role->id, $role_permission->id]) }}" class="btn btn-sm btn-success" id="delete">{{ $role_permission->name }} <i class="fa fa-times"></i></a>

                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Permission</label>
                                                    <select name="permission" id="permission_id" class="select2bs4"
                                                            style="width: 100%;">
                                                      <option value="" selected disabled>Select Permission</option>
                                                      @foreach ($premissions as $permission)

                                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">@error('permission'){{$message}}@enderror</span>
                                                  </div>

                                                </div><!-- col-md-6 -->

                                            </div><!-- row -->

                                                        </div>
                                                        <!-- /.card-body -->
                                                        <div class="card-footer">
                                                          <input type="submit" class="btn btn-danger" value="Assign" >
                                                        </div>
                                                      </form>
                                                    </div>
                      </div>
                      <!--/.col (left) -->
                    </div>
                    <!-- /.row -->
                    </div><!-- /.container-fluid -->
                  </section>
                  <!-- /.content -->
                  @endsection
