@extends('admin.admin_master')
@section('admin')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Course List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Course</li>
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
                                @can('course.create')
                                @auth
                                <a href="{{ route('course.add') }}" style="float: right;" class="btn  bg-{{ auth()->user()->sidebar_color }} mb-5">Add Course</a>
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
                                        <th>Course Code</th>
                                        <th>Main Category</th>
                                        <th>Course Name</th>
                                        <th>Course Category</th>
                                        {{-- <th>Study Board</th> --}}
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $course)
                                    <tr>
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->courseMainCategory->category_name }}</td>
                                        <td>{{ $course->course_name }}</td>
                                        <td>{{ $course->courseCategory->category_name }}</td>
                                        {{-- <td>{{ $course->studyBoardName->name }}</td> --}}
                                        <td>
                                            @can('course.show')
                                            <a href="{{ route('course.show', encrypt($course->id)) }}" class="btn btn-sm btn-primary">Detials <i class="fas fa-eye"></i></a>
                                            @endcan
                                            @can('course.updation')
                                            <a href="{{ route('course.edit', encrypt($course->id)) }}" class="btn btn-sm btn-info">Edit <i class="fas fa-pencil-alt"></i></a>
                                            @endcan
                                            @can('course.delete')
                                            <a href="{{ route('course.delete', encrypt($course->id)) }}" class="btn btn-sm btn-danger" id="delete">Delete <i class="fas fa-trash"></i></a>
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
