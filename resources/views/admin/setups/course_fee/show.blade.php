@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Course Fee Details</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('course.fee.index') }}">Course Fee</a></li>
                        <li class="breadcrumb-item active">Course Fee Add</li>
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
                            <p>Course Name :- <span class="text-dark"><b>{{ $data->course_name }}</b></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-md-5">
                            <p>Course Main Category :- <span
                                    class="text-dark"><b>{{ $data->courseMainCategory->category_name }}</b></span></p>
                        </div>
                        <div class="col col-md-6">
                            <p>Course Type :- <span class="text-dark"><b>
                                        {{ $data->courseCategory->category_name }}</b></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-md-5">
                            <p>Payment Course Code :- <span class="text-dark"><b>
                                        {{ $data->payment_course_code }}</b></span></p>
                        </div>
                        <div class="col col-md-6">
                            <p>Payment Account Number :- <span class="text-dark"><b>
                                        {{ $data->application_acc_number }}</b></span></p>
                        </div>
                    </div>


                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Batch</th>
                                        <th scope="col">Intake</th>
                                        <th scope="col">Payment Type</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($courseFees as $key => $fee)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $fee->reg_year }}</td>
                                            <td>{{ $fee->batch }}</td>
                                            <td>{{ $fee->intake }}</td>
                                            <td>{{ $fee->incomeType->income_type_name }}</td>
                                            <td>Rs. {{ number_format($fee->amount, 2) }}</td>
                                            <td>
                                                <a href="{{ route('course.fee.delete', encrypt($fee->id)) }}"
                                                    class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <form action="{{ route('course.fee.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" id="course_code" name="course_code"
                                    value="{{ $data->id }}">
                                <div class="form-group">
                                    <label>Year <span style="color: #ff0000;"> *</span></label>
                                    <input type="text" class="form-control" id="reg_year" name="reg_year1">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Intake <span style="color: #ff0000;"> *</span></label>
                                    <input type="number" class="form-control" id="intake" name="intake1">
                                </div>
                                <div class="form-group">
                                    <label>Payment Amount <span style="color: #ff0000;"> *</span></label>
                                    <input type="number" class="form-control" id="amount" name="amount1">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="inputState">Batch <span style="color: #ff0000;"> *</span></label>
                                    <input type="number" class="form-control" id="batch" name="batch1">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Income Type<span style="color: #ff0000;"> *</span></label>
                                    <select name="pay_income_type_id1" id="pay_income_type_id" class="select2bs5"
                                        style="width: 100%;">
                                        <option value="0" disabled="" selected="">Select Income Type</option>
                                        @foreach ($incomeTypes as $incomeType)
                                            <option value="{{ $incomeType->id }}">{{ $incomeType->income_type_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <br>
                                <div class="form-group">
                                    <input type="button" onclick="append_row();" value="Add" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-bordered" id="coursefee" name="coursefee">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Year</th>
                                            <th scope="col">Batch</th>
                                            <th scope="col">Intake</th>
                                            <th scope="col">Payment Type</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>

    <script>
        function append_row() {



            var table1 = document.getElementById('coursefee');
            var lastRow = table1.rows.length - 1;

            var reg_year = document.getElementById('reg_year').value;
            var intake = document.getElementById('intake').value;
            var amount = document.getElementById('amount').value;
            var formattedAmount = parseFloat(amount).toFixed(2);
            var batch = document.getElementById('batch').value;

            var pay_income_type_name = $("#pay_income_type_id option:selected").text();
            var pay_income_type_id = document.getElementById('pay_income_type_id').value;

            var course_code = document.getElementById('course_code').value;


            if (course_code == '') {
                Swal.fire({

                    icon: 'info',
                    title: 'Course Fee Add',
                    text: 'Invalid Course Code'
                });

            } else {

                if (reg_year == '') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Course Fee Add',
                        text: 'Please Enter Course Registration Year'
                    });

                } else {

                    if (batch == '') {

                        Swal.fire({
                            icon: 'info',
                            title: 'Course Fee Add',
                            text: 'Please Enter Course Batch'
                        });

                    } else {

                    if (intake == '') {

                        Swal.fire({
                            icon: 'info',
                            title: 'Course Fee Add',
                            text: 'Please Enter Course Batch'
                        });

                    } else {
                        if (pay_income_type_id == 0) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Course Fee Add',
                                text: 'Please Select Course Income Type'
                            });

                        } else {
                            if (amount == '') {

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Course Fee Add',
                                    text: 'Please Enter Course Fee Amount'
                                });

                            } else {

                                $('#coursefee tbody').append(
                                '<tr id="row' + lastRow + '"><td> ' + (lastRow + 1) + '</td>' +
                                '<td><input type="text" class="form-control" name="reg_year[]" value="' + reg_year + '" readonly></td>' +
                                '<td><input type="text" class="form-control" name="batch[]" value="' + batch + '" readonly></td>' +
                                '<td><input type="text" name="intake[]" class="form-control" value="' + intake + '" readonly></td>' +
                                '<td><input type="text" class="form-control" value="' + pay_income_type_name + '" readonly><input type="hidden" name="pay_income_type_id[]" class="form-control" value="' + pay_income_type_id + '" readonly></td>' +
                                '<td><input type="text" class="form-control" name="amount[]" value="' + formattedAmount + '" readonly></td>' +
                                '<td><input type="button" onclick="deleteRow(this);" id="removeItem" name="removeItem" value="Remove" class="btn btn-danger"></td>' +
                                '</tr>'
                                );

                                $('#amount').val('');
                                $('#batch').val('');
                                $('#intake').val('');
                                $('#reg_year').val('');
                                $('#pay_income_type_id').val('0').trigger('change');

                            }

                        }
                    }

                 }
                }
            }

        }

        function deleteRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
@endsection
