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
            <li class="breadcrumb-item active">Category Edit</li>
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
                <h3 class="card-title"><a href="{{ URL::previous() }}"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 30px;"></i></a> Category Edit Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('category.update',$editData->id) }}">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Category Type Name<span class="text-danger"> *</span></label>
                        <select name="category_type_name" id="category_type_name" required class="select2bs4" style="width: 100%" disabled>
                            @foreach($categoryTypes as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $editData->category_type_id ? 'selected ' : '' }} >{{ ucfirst(preg_replace('/[_]/', ' ', $category->name)) }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('category_type_name'){{$message}}@enderror</span>
                      </div>
                      </div><!-- col-md-6 -->
                      {{-- <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                      </div><!-- col-md-6 --> --}}
                   </div><!-- row -->
                   <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Category Name<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="category_name" name="category_name" value="{{$editData->category_name}}">
                        <span class="text-danger">@error('category_name'){{$message}}@enderror</span>
                      </div>
                      </div><!-- col-md-6 -->

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Category Code</label>
                        <input type="text" class="form-control" id="category_code" name="category_code" value="{{$editData->category_code}}">
                      </div>
                      </div><!-- col-md-6 -->
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
