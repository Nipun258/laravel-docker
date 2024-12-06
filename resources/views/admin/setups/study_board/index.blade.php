@extends('admin.admin_master')
@section('admin')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Study Board List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Study Board</li>
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
                                @can('study.board.create')
                                @auth
                                <a href="{{ route('study.board.add') }}" style="float: right;" class="btn  bg-{{ auth()->user()->sidebar_color }} mb-5">Add Study Board</a>
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
                                        <th>Board ID</th>
                                        <th>Name</th>
                                        <th>Short Name</th>
                                        <th>Status</th>
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $study_board)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $study_board->id }}</td>
                                        <td>{{ $study_board->name }}</td>
                                        <td>{{ $study_board->short_name }}</td>
                                        <td>
                                        @if ($study_board->active_status == 0)
                                        <span class="badge badge-pill badge-danger">Inactive</span>
                                        @else
                                        <span class="badge badge-pill badge-success">Active</span>
                                        @endif
                                        </td>
                                        <td>
                                            @can('study.board.show')
                                            <a href="{{ route('study.board.show', encrypt($study_board->id)) }}" class="btn btn-sm btn-primary">Detials <i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can('study.board.updation')
                                            <a href="{{ route('study.board.edit', encrypt($study_board->id)) }}" class="btn btn-sm btn-info">Edit <i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('study.board.delete')
                                            <a href="{{ route('study.board.delete', encrypt($study_board->id)) }}" class="btn btn-sm btn-danger" id="delete">Delete <i class="fas fa-trash"></i></a>
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
