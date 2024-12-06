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
              <h3 class="card-title"><a href="{{ URL::previous() }}"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="font-size: 30px;"></i></a> Study Board Chair Person Add Form</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('study.board.chair.person.store') }}">
              @csrf
              <div class="card-body">
                 <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Study Board<span class="text-danger"> *</span></label>
                        <select name="study_board_id" id="study_board_id" class="select2bs4" style="width: 100%">
                            <option value="" selected disabled>Select Study Board</option>
                            @foreach($studyBoards as $studyBoard)
                            <option value="{{ $studyBoard->id}}" {{  $studyBoard->id == old('study_board_id') ? 'selected' : '' }}>{{ $studyBoard->name}}</option>
                            @endforeach
                        </select>
                          <span class="text-danger">@error('study_board_id'){{$message}}@enderror</span>
                      </div>
                      </div><!-- col-md-12 -->
                   </div><!-- row -->
                   <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Chair Person<span class="text-danger"> *</span></label>
                        <select name="emp_no" id="emp_no" class="select2bs4" style="width: 100%;">
                            <option value="" selected disabled>Select Chair Person</option>
                            @foreach ($empData as $emp)
                            <option value="{{ $emp['employee_no'] }}" {{  $emp['employee_no'] == old('emp_no') ? 'selected' : '' }}>
                                    {{ $emp['employee_no'] }} - {{ $emp['initials'] }} {{ $emp['last_name'] }} {{ $emp['title'] }} - {{ $emp['department_name'] }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('emp_no'){{$message}}@enderror</span>
                      </div>
                      </div><!-- col-md-12 -->
                   </div><!-- row -->
                   <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Appointment Type<span class="text-danger"> *</span></label>
                        <select name="appointment_type_id" id="appointment_type_id" class="select2bs4" style="width: 100%;">
                            <option value="" selected disabled>Select Appointment Type</option>
                            @foreach ($appartmentTypes as $appartmentType)
                                <option value="{{ $appartmentType->id }}" {{  $appartmentType->id == old('appointment_type_id') ? 'selected' : '' }}>{{ $appartmentType->category_name }} </option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('appointment_type_id'){{$message}}@enderror</span>
                      </div>
                      </div><!-- col-md-4 -->
                      <div class="col-md-4">
                        <div class="form-group">
                            <label>Appointment Date<span class="text-danger"> *</span></label>
                              <div class="input-group date" id="start_date" data-target-input="nearest">
                                  <input type="text" class="form-control datetimepicker-input" data-target="#start_date" name="start_date" value="{{ old('start_date') }}" placeholder="Ex:- 01-Jan-2000" data-target="#start_date" data-toggle="datetimepicker">
                                  <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>
                              <span class="text-danger">@error('start_date'){{$message}}@enderror</span>
                          </div>
                        </div><!-- col-md-4 -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Termination Date</label>
                                  <div class="input-group date" id="end_date" data-target-input="nearest">
                                      <input type="text" class="form-control datetimepicker-input" data-target="#end_date" name="end_date" value="{{ old('end_date') }}" placeholder="Ex:- 01-Jan-2000" data-target="#end_date" data-toggle="datetimepicker">
                                      <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                      </div>
                                  </div>
                                  <span class="text-danger">@error('end_date'){{$message}}@enderror</span>
                              </div>
                            </div><!-- col-md-4 -->
                   </div><!-- row -->

              </div>
                <!-- /.card-body -->
              @can('study.board.chair.person.create')
              <div class="card-footer">
                @auth
                <input type="submit" class="btn bg-{{ auth()->user()->sidebar_color }}" value="Create" >
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
