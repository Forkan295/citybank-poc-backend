<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MobileOperator;
use Illuminate\Http\Request;

class MobileOperatorListController extends Controller
{
    public function index()
    {
    	$lists = MobileOperator::all();
    
		return view('list.mobile-operator-list', compact('lists'));
    }
}
