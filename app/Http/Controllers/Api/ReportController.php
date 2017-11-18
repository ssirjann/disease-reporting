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
     */
    public function getTrending(Request $request)
    {
        try {
            $district_id = getDistrictId($request->get('district'));

            $epidemics = Epidemic::whereRaw('end_date IS NULL')
                ->join('reports', 'epidemics.id', '=', 'reports.epidemic_id')
                ->where('district_id', $district_id)
                ->orderBy('epidemics.created_at');

            var_dump($epidemics);
            die;
        } catch (\Exception $e) {

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
}
