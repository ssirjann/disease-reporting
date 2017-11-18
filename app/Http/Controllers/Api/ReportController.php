<?php

namespace App\Http\Controllers\Api;

use App\Disease;
use App\Epidemic;
use App\Report;
use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Get a list of trending diseases
     *
     * @param Request $request
     *
     * @return array
     */
    public function getTrending(Request $request)
    {
        try {
            $district = $request->get('district');

            $query = Report
                ::selectRaw("count(*) as no_of_reports, disease_id, sum(no_of_victims) as no_of_victims, district, min(to_char(reports.created_at, 'Mon dd, yyyy')) as first_reported, epidemic_id, max(to_char(reports.created_at, 'Mon dd, yyyy')) as last_reported")
                ->join('epidemics', 'reports.epidemic_id', '=', 'epidemics.id');

            if ($district && $request->user()->isNormal()) {
                $query->where('district', $district);
            }

            $running = $query->groupBy('disease_id', 'district', 'epidemic_id')->get();

            return [
                'success'  => true,
                'diseases' => $this->formatReports($running),
            ];

        } catch (\Exception $e) {
            \Log::error($e);

            return [
                'success' => 'false',
            ];
        }
    }

    /**
     * @param ReportRequest $request
     *
     * @return array
     */
    public function create(ReportRequest $request)
    {
        try {
            $priority = $request->get('no_of_victims') *
            ($request->user() && $request->user()->isAuthorized()) ? 5 : 1;

            $disease_id = getDistrictId($request->get('disease'));

            Report::create([
                'location'      => $request->get('location') ?: null,
                'district'      => $request->get('district'),
                'disease_id'    => $disease_id,
                'priority'      => $priority,
                'user_id'       => $request->user()->id,
                'no_of_victims' => $request->get('no_of_victims'),
            ]);

            return [
                'success' => true,
                'message' => "Report successfully posted",
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => "Error!",
            ];

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report $report
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report $report
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Report              $report
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report $report
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }

    /**
     * Return a json for given reports
     *
     * @param $reports
     *
     * @return array
     *
     */
    private function formatReports($reports)
    {
        $returnArray = [];

        foreach ($reports as $report) {
            $returnArray[] = [
                'disease'        => $report->disease->name,
                'district'       => $report->district,
                'no_of_reports'  => $report->no_of_reports,
                'no_of_victims'  => $report->no_of_victims,
                'first_reported' => $report->first_reported,
                'last_reported'  => $report->last_reported,
            ];
        }

        return $returnArray;
    }
}
