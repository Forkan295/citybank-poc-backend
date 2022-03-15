<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MobileOperator;

class MobileOperatorListController extends Controller
{
    public function index()
    {
    	$lists = MobileOperator::all();
    
		return view('list.mobile-operator-list', compact('lists'));
    }
}
