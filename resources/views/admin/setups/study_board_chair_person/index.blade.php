@extends('admin.admin_master')
@section('admin')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Study Board Chair Person List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Study Board Chair Person</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-12">
                                @can('study.board.chair.person.create')
                                @auth
                                <a href="{{ route('study.board.chair.person.add') }}" style="float: right;" class="btn  bg-{{ auth()->user()->sidebar_color }} mb-5">Add Study Board Chair Person</a>
                                @endauth
                                @endcan
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">SN</th>
                                        <th>Study Board</th>
                                        <th>Emp No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Appointment date</th>
                                        <th>Termination date</th>
                                        <th>Appointment Type</th>
                                        <th width="16%" data-priority="1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($data->isEmpty())
                                    @else
                                    @foreach($data as $key => $study_board_chair_person)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $study_board_chair_person->studyBoardName->name }}</td>
                                        <td>{{ $study_board_chair_person->emp_no }}</td>
                                        <td>{{ $study_board_chair_person->title }} {{ $study_board_chair_person->initial }} {{ $study_board_chair_person->LName }}</td>
                                        <td>{{ $study_board_chair_person->email }}</td>
                                        <td>{{ $study_board_chair_person->start_date }}</td>
                                        <td>{{ $study_board_chair_person->end_date }}</td>
                                        <td>{{ $study_board_chair_person->appointmentTypeName->category_name }}</td>
                                        <td>
                                            @can('study.board.chair.person.updation')
                                            <a href="{{ route('study.board.chair.person.edit', encrypt($study_board_chair_person->id)) }}" class="btn btn-sm btn-info">Edit <i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('study.board.chair.person.delete')
                                            <a href="{{ route('study.board.chair.person.delete', encrypt($study_board_chair_person->id)) }}" class="btn btn-sm btn-danger" id="delete">Delete <i class="fas fa-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach

                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
