<?php

namespace App\Http\Controllers\Admin;

use App\Epidemic;
use App\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;

class EpidemicController extends Controller
{
    public function resolve(Epidemic $epidemic)
    {
        $epidemic->end_date = now();
        $epidemic->save();

        return redirect()->route('admin.home');
    }

    /**
     * Marks certain reports as a part of an epidemic
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        try {
            $date = new Carbon($request->get('from'));

            $where = [
                'disease_id' => $request->get('disease_id'),
                'district'   => $request->get('district'),
            ];

            \DB::beginTransaction();

            $epidemic = Epidemic::create(['start_date' => $date]);

            Report::where($where)->whereNull('epidemic_id')->whereDate('created_at', '>', $date)->update(['epidemic_id' => $epidemic->id]);
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();

            \Log::error($e);
        }

        return redirect()->route('admin.home');
    }

}
