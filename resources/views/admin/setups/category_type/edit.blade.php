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
            <li class="breadcrumb-item active">Category Type Edit</li>
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
                <h3 class="card-title"><a href="{{ URL::previous() }}"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 30px;"></i></a> Category Type Edit Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('category.type.update',$editData->id) }}">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Category Type Name<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$editData->name}}">
                        <span class="text-danger">@error('name'){{$message}}@enderror</span>
                      </div>
                      </div><!-- col-md-6 -->
                      {{-- <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                      </div><!-- col-md-6 --> --}}
                   </div><!-- row -->

                </div>
                  <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" value="Update" >
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
