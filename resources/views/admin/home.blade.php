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
                            <h3 class="box-title">Running Reports</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>District</th>
                                    <th>Disease</th>
                                    <th>No of reports</th>
                                    <th>No of victims</th>
                                    <th>First reported</th>
                                    <th>Last reported</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($running as $report)
                                    <tr>
                                        <td>{{ucfirst($report->district)}}</td>
                                        <td>{{$report->disease->name}}</td>
                                        <td>{{$report->no_of_reports}}</td>
                                        <td>{{$report->no_of_victims}}</td>
                                        <td>{{$report->first_reported}}</td>
                                        <td>{{$report->last_reported}}</td>
                                        <td><a class="btn btn-danger" href="#!" id=""><i class="fa fa-check-square-o"></i> Mark as an epidemic</a></td>
                                    </tr>
                                @endforeach
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
                            <h3 class="box-title">Review diseases</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>District</th>
                                    <th>Disease</th>
                                    <th>No of reports</th>
                                    <th>No of victims</th>
                                    <th>First reported</th>
                                    <th>Last reported</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($review as $report)
                                    <tr>
                                        <td>{{ucfirst($report->district)}}</td>
                                        <td>{{$report->disease->name}}</td>
                                        <td>{{$report->no_of_reports}}</td>
                                        <td>{{$report->no_of_victims}}</td>
                                        <td>{{$report->first_reported}}</td>
                                        <td>{{$report->last_reported}}</td>
                                        <td><a class="btn btn-primary" href="#!" id=""><i class="fa fa-check-square-o"></i> Mark as resolved</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
