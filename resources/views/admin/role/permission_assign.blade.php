@extends('admin.admin_master')
@section('admin')
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><a href="{{ route('role.index') }}"><i class="fa fa-arrow-circle-left" aria-hidden="true"
                                        style="font-size: 30px;"></i></a> Permission Assign to Role</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">

                            <form method="post" action="">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-12 text-center">
                                        <input type="checkbox" name="permission1" id="all" class="form-check-input"
                                            onclick=" for(c in document.getElementsByName('permission[]')) document.getElementsByName('permission[]').item(c).checked = this.checked" />
                                        <label for="all">Select All Permissions</label><br>
                                        <span class="text-danger">
                                            @error('permission1')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            @foreach ($premissions as $key => $permission)
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td align="center" width="60%">
                                                        <input type="checkbox"
                                                            name="permission[]" id="{{ $permission->id }}"
                                                            class="form-check-input"
                                                            value="{{ $permission->name }}"
                                                            {{ $role->permissions->contains($permission->id) ? 'checked' : '' }} />
                                                        <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
