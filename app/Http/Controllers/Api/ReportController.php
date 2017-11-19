<?php

namespace App\Http\Controllers\Api;

use App\Disease;
use App\Epidemic;
use App\Http\Requests\SuggestionRequest;
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
    public function trending(Request $request)
    {
        try {
            $district = $request->get('district');

            $query = Report
                ::selectRaw("count(*) as no_of_reports, disease_id, sum(no_of_victims) as no_of_victims, district, min(to_char(reports.created_at, 'Mon dd, yyyy')) as first_reported, epidemic_id, max(to_char(reports.created_at, 'Mon dd, yyyy')) as last_reported")
                ->join('epidemics', 'reports.epidemic_id', '=', 'epidemics.id')
                ->whereRaw('epidemics.end_date IS NULL');

            if ($district && $request->user()->isNormal()) {
                $query->where('district', $district);
            }

            $running = $query->groupBy('disease_id', 'district', 'epidemic_id')->get();

            foreach ($running as &$report) {
                $report->district = $this->getMinDistance($request, $report, 'trending');
            }

            return [
                'success'  => true,
                'diseases' => $this->formatReports($running, 'trending'),
            ];

        } catch (\Exception $e) {
            \Log::error($e);

            return [
                'success' => 'false',
            ];
        }
    }

    /**
     * Get a list of solved diseases
     *
     * @param Request $request
     *
     * @return array
     */
    public function history(Request $request)
    {
        try {

            $district = $request->get('district');

            $query = Report
                ::selectRaw("count(*) as no_of_reports, disease_id, sum(no_of_victims) as no_of_victims, district, min(to_char(reports.created_at, 'Mon dd, yyyy')) as start_date, epidemic_id, max(to_char(reports.created_at, 'Mon dd, yyyy')) as end_date")
                ->join('epidemics', 'reports.epidemic_id', '=', 'epidemics.id')
                ->whereRaw('epidemics.end_date IS NOT NULL');

            if ($district && $request->user()->isNormal()) {
                $query->where('district', $district);
            }

            $running = $query->groupBy('disease_id', 'district', 'epidemic_id')->get();

            foreach ($running as &$report) {
                $report->district = $this->getMinDistance($request, $report, 'trending');
            }

            return [
                'success'  => true,
                'diseases' => $this->formatReports($running, 'history'),
            ];

        } catch (\Exception $e) {
            \Log::error($e);

            return [
                'success' => 'false',
            ];
        }
    }

    /**
     * Get a list of solved diseases
     *
     * @param Request $request
     *
     * @return array
     */
    public function unverified(Request $request)
    {
        try {

            $district = $request->get('district');

            $query = Report
                ::selectRaw("count(*) as no_of_reports, disease_id, sum(no_of_victims) as no_of_victims, district, min(to_char(reports.created_at, 'Mon dd, yyyy')) as first_reported, epidemic_id, max(to_char(reports.created_at, 'Mon dd, yyyy')) as last_reported")
                ->whereRaw('epidemic_id IS NULL');

            if ($district && $request->user()->isNormal()) {
                $query->where('district', $district);
            }

            $running = $query->groupBy('disease_id', 'district', 'epidemic_id')->get();

            foreach ($running as &$report) {
                $report->district = $this->getMinDistance($request, $report, 'trending');
            }

            return [
                'success'  => true,
                'diseases' => $this->formatReports($running, 'unverified'),
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
            $location = null;

            if ($request->get('latitude') && $request->get('longitude')) {
                $location = json_encode([
                    'latitude'  => $request->get('latitude'),
                    'longitude' => $request->get('longitude'),
                ]);
            }

            $priority = $request->get('no_of_victims') *
                (($request->user() && $request->user()->isAuthorized()) ? 5 : 1);

            $disease_id = getDiseaseId($request->get('disease'));

            Report::create([
                'district'      => $request->get('district'),
                'disease_id'    => $disease_id,
                'priority'      => $priority,
                'user_id'       => $request->user()->id,
                'no_of_victims' => $request->get('no_of_victims'),
                'location'      => $location,
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

    public function addSuggestion(SuggestionRequest $request)
    {
        try {
            \DB::beginTransaction();

            $disease_id = getDiseaseId($request->get('disease'));

            $disease              = Disease::find($disease_id);
            $disease->description = $request->get('text');
            $disease->save();
            \DB::commit();

            return ['success' => true];
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e);

            return ['success' => false];
        }
    }

    /**
     * Return a json for given reports
     *
     * @param $reports
     *
     * @param $type
     *
     * @return array
     */
    private function formatReports($reports, $type = 'trending')
    {
        $returnArray = [];

        if ($type == 'trending' || $type == 'unverified') {
            foreach ($reports as $report) {
                $returnArray[] = [
                    'disease'        => $report->disease->name,
                    'district'       => $report->district,
                    'no_of_reports'  => $report->no_of_reports,
                    'no_of_victims'  => $report->no_of_victims,
                    'first_reported' => $report->first_reported,
                    'last_reported'  => $report->last_reported,
                    'image_link'     => 'https://lh5.ggpht.com/tq3WqEUxtRyBn-d_0t3j6WKNHuJDrmLq-FE3GAYrsAMQFIaS7FIgRLfzzql2SvfvLqto=w300',
                    'description'    => $report->disease->description,
                ];
            }
        } elseif ($type == 'history') {
            foreach ($reports as $report) {
                $returnArray[] = [
                    'disease'       => $report->disease->name,
                    'district'      => $report->district,
                    'no_of_reports' => $report->no_of_reports,
                    'no_of_victims' => $report->no_of_victims,
                    'start_date'    => $report->start_date,
                    'end_date'      => $report->end_date,
                    'image_link'    => 'https://lh5.ggpht.com/tq3WqEUxtRyBn-d_0t3j6WKNHuJDrmLq-FE3GAYrsAMQFIaS7FIgRLfzzql2SvfvLqto=w300',
                    'description'   => $report->disease->description,
                ];
            }
        }

        return $returnArray;
    }

    public function getMinDistance($request, $report, $type)
    {
        $lat1 = $request->get('latitude');
        $lon1 = $request->get('longitude');

        $locations = Report::where('district', $report->district)->where('disease_id', $report->disease_id);

        if ($type == 'trending') {
            $locations = $locations->join('epidemics', 'reports.epidemic_id', '=', 'epidemics.id')->whereNull('end_date');
        } elseif ($type == 'history') {
            $locations = $locations->join('epidemics', 'reports.epidemic_id', '=', 'epidemics.id')->whereNotNull('end_date');
        } elseif ($type == 'unverified') {
            $locations = $locations->whereNull('epidemic_id');
        }

        $locations = $locations->pluck('location');
        $locations = $locations->toArray();

        foreach ($locations as $index => $location) {
            $loc               = json_decode($location, true);
            $locations[$index] = getDistance($lat1, $lon1, $loc['latitude'], $loc['longitude']);
        }

        $distance = min($locations);

        return round($distance, 2);
    }
}
