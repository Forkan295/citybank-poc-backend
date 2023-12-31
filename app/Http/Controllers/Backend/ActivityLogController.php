<?php

namespace App\Http\Controllers\Backend;

use Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
    	$activityLogs = Activity::paginate();

    	return view('activity-log.index', compact('activityLogs'));
    }

    public function show($id) {
    	$activityLog = Activity::findOrFail($id);

    	return view('activity-log.show', compact('activityLog'));
    }
}
