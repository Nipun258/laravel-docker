@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Course Details</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('course.index') }}">Course</a></li>
                        <li class="breadcrumb-item active">Course Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col col-md-5">
                            <p>Course Code :- <span class="text-dark"><b> {{ $data->id }}</b></span></p>
                        </div>
                        <div class="col col-md-6">
                            <p>Course Name :- <span
                                    class="text-dark"><b>{{ $data->course_name }}</b></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-md-5">
                            <p>Course Main Category :- <span
                                    class="text-dark"><b>{{ $data->courseMainCategory->category_name }}</b></span></p>
                        </div>
                        <div class="col col-md-6">
                            <p>Course Type :- <span
                                    class="text-dark"><b> {{ $data->courseCategory->category_name }}</b></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-md-5">
                            <p>Study Board :- <span class="text-dark"><b> {{ $data->studyBoardName->name }}</b></span></p>
                        </div>
                        <div class="col col-md-6">
                            <p>Course Application Open Method :- <span class="text-dark"><b> {{ $data->courseApplicationOpenMethod->category_name }}</b></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-md-5">
                            <p>Payment Course Code :- <span class="text-dark"><b> {{ $data->payment_course_code }}</b></span></p>
                        </div>
                        <div class="col col-md-6">
                            <p>Payment Account Number :- <span class="text-dark"><b> {{ $data->application_acc_number }}</b></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-md-5">
                            <p>Course Medium :- <span class="text-dark"><b> {{ $data->courseMediumName->category_name }}</b></span></p>
                        </div>
                        <div class="col col-md-5">
                            <p>Old Course Code :- <span class="text-dark"><b> {{ $data->previous_course_code }}</b></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-5">
                            <p>Active Status :-
                                @if ($data->active_status == 1)
                                <button class="btn-success btn-sm" type="button" disabled>Active</button>
                                @else
                                <button class="btn-danger btn-sm" type="button" disabled>Inactive</button>
                                @endif

                            </p>
                        </div>
                    </div>
                </div>
            </div>






        </div>
    </section>
@endsection
