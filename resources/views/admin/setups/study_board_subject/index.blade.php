@extends('admin.admin_master')
@section('admin')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Study Board Subject List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Study Board Subject</li>
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
                                @can('study.board.subject.create')
                                @auth
                                <a href="{{ route('study.board.subject.add') }}" style="float: right;" class="btn  bg-{{ auth()->user()->sidebar_color }} mb-5">Add Study Board Subject</a>
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
                                        <th>Subject ID</th>
                                        <th>Study Board</th>
                                        <th>Subject Name</th>
                                        <th>Status</th>
                                        <th width="21%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $study_board_subject)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $study_board_subject->id }}</td>
                                        <td>{{ $study_board_subject->studyBoardName->name }}</td>
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
                                            @can('study.board.subject.delete')
                                            <a href="{{ route('study.board.subject.delete', encrypt($study_board_subject->id)) }}" class="btn btn-sm btn-danger" id="delete">Delete <i class="fas fa-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
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
