@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Study Board Details</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('study.board.index') }}">Study Board</a></li>
                        <li class="breadcrumb-item active">Study Board Details</li>
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
                            <p>Study Board ID :- <span class="text-dark"><b> {{ $data->id }}</b></span></p>
                        </div>
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

                    <div class="row">
                        <div class="col col-md-5">
                            <p>Study Board Name :- <span
                                    class="text-dark"><b>{{ $data->name }}</b></span></p>
                        </div>
                        <div class="col col-md-5">
                            <p>Study Board Short Name :- <span
                                    class="text-dark"><b> {{ $data->short_name }}</b></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="background-color: #fffccd;">
                <div class="card-header">
                    <h2 class="card-title"><b>Study Board Chair Person</b></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-10">
                    <div class="row">
                        <div class="col col-md-10">
                            <p>Chair Person Full Name :- <span class="text-dark"><b> {{ $studyBoardChairPersonDetails[0]['title'] }} {{ $studyBoardChairPersonDetails[0]['name_denoted_by_initials'] }} {{ $studyBoardChairPersonDetails[0]['last_name'] }}</b></span></p>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col col-md-6">
                            <p>Name With Initials:- <span class="text-dark"><b> {{ $studyBoardChairPersonDetails[0]['title'] }} {{ $studyBoardChairPersonDetails[0]['initials'] }} {{ $studyBoardChairPersonDetails[0]['last_name'] }}</b></span></p>
                        </div>
                        <div class="col col-md-6">
                            <p>Chair Person Employee No :- <span class="text-dark"><b> {{ $studyBoardChairPersonDetails[0]['employee_no'] }}</b></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-md-6">
                            <p>Chair Person Email :- <span class="text-dark"><b> {{ $studyBoardChairPersonDetails[0]['email'] }}</b></span></p>
                        </div>
                        <div class="col col-md-6">
                            <p>Chair Person Mobile :- <span class="text-dark"><b> {{ $studyBoardChairPersonDetails[0]['mobile_no'] }}</b></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-md-6">
                            <p>Chair Person Appointment Date :- <span class="text-dark"><b> {{  date("d-M-Y", strtotime($studyBoardChairPerson->start_date)) }}</b></span></p>
                        </div>
                        <div class="col col-md-6">
                            <p>Chair Person Termination Date :- <span class="text-dark"><b> {{ $studyBoardChairPerson->end_date && $studyBoardChairPerson->end_date !== '1970-01-01'
                                ? date("d-M-Y", strtotime($studyBoardChairPerson->end_date))
                                : 'N/A' }}</b></span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-6">
                            <p>Chair Person Active Status :- <span class="text-dark"><b>@if ($studyBoardChairPersonDetails[0]['employee_status_id'] == 110)
                                <button class="btn-success btn-sm" type="button" disabled>Active</button>
                                @else
                                <button class="btn-danger btn-sm" type="button" disabled>Inactive</button>
                                @endif</b></span></p>
                        </div>
                        <div class="col col-md-6">
                            <p>Chair Person Appointment Type :- <span class="text-dark"><b> {{  $studyBoardChairPerson->appointmentTypeName->category_name }}</b></span></p>
                        </div>
                    </div>
                        </div>
                        <div class="col-2">
                            <div class="text-center">
                                @php
                                    if ($studyBoardChairPersonDetails[0] != null) {
                                        $empNo = $studyBoardChairPersonDetails[0]['employee_no'];
                                    } else {
                                        $empNo = 12394;
                                    }

                                    $imageUrl =
                                        'https://hrms.sjp.ac.lk/backend/dist/img/profile/' . $empNo . '.jpg';
                                    $imageExists = false;

                                    // Check if the image URL exists and is a valid image
                                    if (@getimagesize($imageUrl)) {
                                        $imageExists = true;
                                    }
                                @endphp

                                @if ($imageExists)
                                    <img src="{{ $imageUrl }}"
                                        class="img-responsive mx-auto d-block img-fluid border border-dark img-thumbnail"
                                        style="width: 150px;" alt="profile-image">
                                @else
                                    <img src="https://hrms.sjp.ac.lk/backend/dist/img/profile.jpg"
                                        class="img-responsive mx-auto d-block img-fluid border border-dark img-thumbnail"
                                        style="width: 150px;" alt="profile-image">
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><b>Active Study Board Subject List</b></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="example2" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Subject ID</th>
                                        <th scope="col">Subject Name</th>
                                        <th scope="col">Active Status</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studyBoardSubjects as $key => $study_board_subject)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $study_board_subject->id }}</td>
                                        <td>{{ $study_board_subject->name }}</td>
                                        <td>
                                        @if ($study_board_subject->active_status == 0)
                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                        @else
                                        <span class="badge badge-pill badge-success">Active</span>
                                        @endif
                                        </td>
                                        <td>
                                            @can('study.board.subject.updation')
                                            <a href="{{ route('study.board.subject.edit', encrypt($study_board_subject->id)) }}" class="btn btn-sm btn-info">Edit <i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
