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
            @auth
            <div class="card card-{{ auth()->user()->sidebar_color }}">
            @endauth
              <div class="card-header">
                <h3 class="card-title"><a href="{{ URL::previous() }}"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 30px;"></i></a> Income Type Edit Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('income.type.update',$editData->id) }}">
                @csrf
                <div class="card-body">
                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Payment Income Type Code<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="pay_income_type_code" name="pay_income_type_code" value="{{$editData->pay_income_type_code}}">
                        <span class="text-danger">@error('pay_income_type_code'){{$message}}@enderror</span>
                      </div>
                      </div><!-- col-md-6 -->
                   </div><!-- row -->

                   <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Income type Name<span class="text-danger"> *</span></label>
                        <input type="text" class="form-control" id="income_type_name" name="income_type_name" value="{{$editData->income_type_name}}">
                        <span class="text-danger">@error('income_type_name'){{$message}}@enderror</span>
                      </div>
                      </div><!-- col-md-6 -->
                   </div><!-- row -->

                </div>
                  <!-- /.card-body -->
                @can('income.type.updation')
                <div class="card-footer">
                    @auth
                    <input type="submit" class="btn bg-{{ auth()->user()->sidebar_color }}" value="Update">
                    <a href="{{ route('income.type.index') }}" class="btn {{ auth()->user()->sidebar_color == 'yellow' ? 'btn-dark' : 'btn-warning'}}">Cancel</a>
                    @endauth
                    </div>
                @endcan

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
