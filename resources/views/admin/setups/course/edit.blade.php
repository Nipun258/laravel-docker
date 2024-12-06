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
                                        aria-hidden="true" style="font-size: 30px;"></i></a> Course Edit Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('course.update',$editData->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Course Main Category<span class="text-danger"> *</span></label>
                                            <select name="course_main_category" id="course_main_category" class="select2bs4"
                                                style="width: 100%">
                                                <option value="" selected disabled>Select Main Category</option>
                                                @foreach ($courseMainCategories as $courseMainCategory)
                                                    <option value="{{ $courseMainCategory->id }}"
                                                        {{ $courseMainCategory->id == $editData->course_main_category ? 'selected' : '' }}>
                                                        {{ $courseMainCategory->category_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">
                                                @error('course_main_category')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div><!-- col-md-6 -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Study Board<span class="text-danger"> *</span></label>
                                            <select name="study_board_id" id="study_board_id" class="select2bs4"
                                                style="width: 100%">
                                                <option value="0" selected>Select Study Board</option>
                                                @foreach ($studyBoards as $studyBoard)
                                                    <option value="{{ $studyBoard->id }}"
                                                        {{ $studyBoard->id == $editData->study_board_id ? 'selected' : '' }}>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Course Category<span class="text-danger"> *</span></label>
                                            <select name="course_cat_id" id="course_cat_id" class="select2bs4"
                                                style="width: 100%">
                                                <option value="" selected disabled>Select Course Category</option>
                                                @foreach ($courseTypes as $courseType)
                                                    <option value="{{ $courseType->id }}"
                                                        {{ $courseType->id == $editData->course_cat_id ? 'selected' : '' }}>
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
                                                name="previous_course_code" value="{{ $editData->previous_course_code }}">
                                            <span class="text-danger">
                                                @error('previous_course_code')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div><!-- col-md-12 -->

                                    <div class="col-md-8">
                                        <label for="">Course Name <span class="text-danger"> *</span></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="course_name" name="course_name"
                                                value="{{ $editData->course_name }}">
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
                                                value="{{ $editData->payment_course_code }}">
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
                                                value="{{ $editData->application_acc_number }}">
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
                                                        {{ $courseMedium->id == $editData->medium_cat_id ? 'selected' : '' }}>
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
                                                        {{ $courseApplicationOpenMethod->id == $editData->course_application_open_method ? 'selected' : '' }}>
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
                            @can('course.updation')
                                <div class="card-footer">
                                    @auth
                                        <input type="submit" class="btn bg-{{ auth()->user()->sidebar_color }}" value="Update">
                                        <a href="{{ route('course.index') }}" class="btn {{ auth()->user()->sidebar_color == 'yellow' ? 'btn-dark' : 'btn-warning'}}">Cancel</a>
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
