@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Overview
            </h1>
            {{--<ol class="breadcrumb">--}}
            {{--<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>--}}
            {{--<li class="active">Dashboard</li>--}}
            {{--</ol>--}}
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Report Verification</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>District</th>
                                    <th>First reported</th>
                                    <th>Last reported</th>
                                    <th>No of reports</th>
                                    <th>No of victims</th>
                                    <th>Action - Verify</th>
                                </tr>
                                <tr>
                                    <td>District</td>
                                    <td>First reported</td>
                                    <td>Last reported</td>
                                    <td>No of reports</td>
                                    <td>No of victims</td>
                                    <td>Action - Verify</td>
                                </tr>
                                <tr>
                                    <td>District</td>
                                    <td>First reported</td>
                                    <td>Last reported</td>
                                    <td>No of reports</td>
                                    <td>No of victims</td>
                                    <td>Action - Verify</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        {{-- SECTION 2--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Running diseases</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>District</th>
                                    <th>First reported</th>
                                    <th>Last reported</th>
                                    <th>No of reports</th>
                                    <th>No of victims</th>
                                    <th>Action - Verify</th>
                                </tr>
                                <tr>
                                    <td>District</td>
                                    <td>First reported</td>
                                    <td>Last reported</td>
                                    <td>No of reports</td>
                                    <td>No of victims</td>
                                    <td>Action - Verify</td>
                                </tr>
                                <tr>
                                    <td>District</td>
                                    <td>First reported</td>
                                    <td>Last reported</td>
                                    <td>No of reports</td>
                                    <td>No of victims</td>
                                    <td>Action - Verify</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
