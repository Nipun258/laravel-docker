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
                            <h3 class="card-title"><a href="{{ URL::previous() }}"><i class="fa fa-arrow-circle-left"
                                        aria-hidden="true" style="font-size: 30px;"></i></a> Course Add Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('course.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Study Board<span class="text-danger"> *</span></label>
                                            <select name="study_board_id" id="study_board_id" class="select2bs4"
                                                style="width: 100%">
                                                <option value="" selected disabled>Select Study Board</option>
                                                @foreach ($studyBoards as $studyBoard)
                                                    <option value="{{ $studyBoard->id }}"
                                                        {{ $studyBoard->id == old('study_board_id') ? 'selected' : '' }}>
                                                        {{ $studyBoard->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('study_board_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div><!-- col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Course Category<span class="text-danger"> *</span></label>
                                            <select name="course_cat_id" id="course_cat_id" class="select2bs4"
                                                style="width: 100%">
                                                <option value="" selected disabled>Select Course Category</option>
                                                @foreach ($courseTypes as $courseType)
                                                    <option value="{{ $courseType->id }}"
                                                        {{ $courseType->id == old('course_cat_id') ? 'selected' : '' }}>
                                                        {{ $courseType->category_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('course_cat_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div><!-- col-md-6 -->
                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Old Course Code</label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="previous_course_code"
                                                name="previous_course_code" value="{{ old('previous_course_code') }}">
                                            <span class="text-danger">
                                                @error('previous_course_code')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div><!-- col-md-12 -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Course Name<span class="text-danger"> *</span></label>
                                            <select name="course_name_id" id="course_name_id" class="select2bs4"
                                                style="width: 100%">
                                                <option value="" selected disabled>Select Course Type</option>
                                                @foreach ($courseTypeExtensions as $courseTypeExtension)
                                                    <option value="{{ $courseTypeExtension->category_name }}"
                                                        {{ $courseTypeExtension->category_name == old('course_name_id') ? 'selected' : '' }}>
                                                        {{ $courseTypeExtension->category_name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div><!-- col-md-12 -->
                                    <div class="col-md-5">
                                        <label for="">&nbsp;</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="course_name" name="course_name"
                                                value="{{ old('course_name') }}">
                                                <span class="text-danger">
                                                    @error('course_name')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                        </div>
                                    </div><!-- col-md-12 -->
                                </div><!-- row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Payment Course Code<span class="text-danger"> *</span></label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="payment_course_code" name="payment_course_code"
                                                value="{{ old('payment_course_code') }}">
                                            <span class="text-danger">
                                                @error('payment_course_code')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div><!-- col-md-4 -->
                                    <div class="col-md-6">
                                        <label for="">Payment Account Number<span class="text-danger"> *</span></label>
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="application_acc_number" name="application_acc_number"
                                                value="{{ old('application_acc_number') }}">
                                            <span class="text-danger">
                                                @error('application_acc_number')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div><!-- col-md-4 -->
                                </div><!-- row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Course Medium<span class="text-danger"> *</span></label>
                                            <select name="medium_cat_id" id="medium_cat_id" class="select2bs4"
                                                style="width: 100%;">
                                                <option value="" selected disabled>Select Course Medium</option>
                                                @foreach ($courseMediums as $courseMedium)
                                                    <option value="{{ $courseMedium->id }}"
                                                        {{ $courseMedium->id == old('medium_cat_id') ? 'selected' : '' }}>
                                                        {{ $courseMedium->category_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('medium_cat_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div><!-- col-md-4 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Course Application Open Method<span class="text-danger"> *</span></label>
                                            <select name="course_application_open_method" id="course_application_open_method" class="select2bs4"
                                                style="width: 100%;">
                                                <option value="" selected disabled>Select Course Application Open Method</option>
                                                @foreach ($courseApplicationOpenMethods as $courseApplicationOpenMethod)
                                                    <option value="{{ $courseApplicationOpenMethod->id }}"
                                                        {{ $courseApplicationOpenMethod->id == old('course_application_open_method') ? 'selected' : '' }}>
                                                        {{ $courseApplicationOpenMethod->category_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('course_application_open_method')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div><!-- col-md-4 -->

                                </div><!-- row -->

                            </div>
                            <!-- /.card-body -->
                            @can('course.create')
                                <div class="card-footer">
                                    @auth
                                        <input type="submit" class="btn bg-{{ auth()->user()->sidebar_color }}" value="Create">
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
