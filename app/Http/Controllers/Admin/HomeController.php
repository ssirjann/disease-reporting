<?php

namespace App\Http\Controllers\Admin;

use App\Epidemic;
use App\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $review = Report
            ::selectRaw("count(*) as no_of_reports, disease_id, sum(priority) as priority, sum(no_of_victims) as no_of_victims, district, min(to_char(created_at, 'Mon dd, yyyy')) as first_reported, max(to_char(created_at, 'Mon dd, yyyy')) as last_reported")
            ->groupBy('disease_id', 'district')
            ->havingRaw('sum(priority) >= 5')
            ->whereRaw('epidemic_id IS NULL')
            ->get();

        $running = Report
            ::selectRaw("count(*) as no_of_reports, epidemic_id, disease_id, sum(no_of_victims) as no_of_victims, district, min(to_char(reports.created_at, 'Mon dd, yyyy')) as first_reported, epidemic_id, max(to_char(reports.created_at, 'Mon dd, yyyy')) as last_reported")
            ->join('epidemics', 'reports.epidemic_id', '=', 'epidemics.id')
            ->whereRaw('epidemics.end_date IS NULL')
            ->groupBy('disease_id', 'district', 'epidemic_id')
            ->get();

        return view('admin.home', compact('running', 'review'));
    }

}
