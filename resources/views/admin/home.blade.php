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
                            <h3 class="box-title">Running Diseases</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            @if(count($running) > 0)
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
                                            <span class="{{$report->district.''}}}" data-disease-id="{{$report->disease_id}}"
                                                  data-district="{{$report->district}}"></span>
                                            <td><a class="btn btn-primary" href="{{route('admin.epidemic.resolve', $report->epidemic_id)}}"
                                                   onclick="return confirm('Mark epidemic as resolved?')" id=""><i
                                                            class="fa fa-check-square-o"></i> Mark as resolved</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                No Running Diseases
                            @endif
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
                            @if(count($review) > 0)
                                <table class="table table-striped">
                                    <tr>
                                        <th>District</th>
                                        <th>Disease</th>
                                        <th>No of reports</th>
                                        <th>No of victims</th>
                                        <th>First reported</th>
                                        <th>Last reported</th>
                                        <th>Date of start</th>
                                    </tr>
                                    @foreach($review as $report)
                                        <tr>
                                            <td>{{ucfirst($report->district)}}</td>
                                            <td>{{$report->disease->name}}</td>
                                            <td>{{$report->no_of_reports}}</td>
                                            <td>{{$report->no_of_victims}}</td>
                                            <td>{{$report->first_reported}}</td>
                                            <td>{{$report->last_reported}}</td>
                                            <td>
                                                <form action="{{route('admin.epidemic.create')}}">
                                                    <div class="form-group col-sm-6">
                                                        <input type="text" class="form-control" name="from" id="date-from">
                                                        <input type="hidden" name="disease_id" value="{{$report->disease_id}}">
                                                        <input type="hidden" name="district" value="{{$report->district}}">
                                                    </div>
                                                    <button type="submit" class="btn btn-danger  col-sm-6">
                                                        <i class="fa fa-check-square-o"></i> Mark as an
                                                        epidemic
                                                    </button>
                                                </form>

                                            </td>

                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                No reports needing review
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
