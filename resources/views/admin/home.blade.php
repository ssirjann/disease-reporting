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
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#markEpidemicModel">
                                                    <i class="fa fa-check-square-o"></i> Mark as an
                                                    epidemic
                                                </button>
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






<div class="modal fade" id="markEpidemicModel" tabindex="-1" role="dialog" aria-labelledby="markEpidemicModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="markEpidemicModelLabel">
                    Select date from which the reports should be made as a part of epidemic
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="message-text" class="form-control-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>
