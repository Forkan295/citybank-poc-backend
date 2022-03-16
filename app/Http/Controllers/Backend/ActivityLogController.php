<?php

namespace App\Http\Controllers\Backend;

use Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivitylogController extends Controller
{
    public function index()
    {
    	$activityLogs = Activity::paginate();

    	return view('activity-log.index', compact('activityLogs'));
    }

    public function show($id) {
    	$activityLog = Activity::where('id', $id)->first();

    	return view('activity-log.show', compact('activityLog'));
    }
}
