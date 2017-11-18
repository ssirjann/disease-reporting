<?php

namespace App\Http\Controllers\Admin;

use App\Epidemic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EpidemicController extends Controller
{
    public function resolve(Epidemic $epidemic)
    {
        $epidemic->end_date = now();
        $epidemic->save();

        return redirect()->route('admin.home');
    }
}
