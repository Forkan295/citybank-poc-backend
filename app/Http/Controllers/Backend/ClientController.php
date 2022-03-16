<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankList;

class ClientController extends Controller
{
    public function index(Request $request)
    {
    	$clients = $request->user()->clients;

    	return view('client.index', compact('clients'));
    }

    public function create()
    {
    	return view('client.create');
    }

    public function store(Request $request)
    {
    	dd($request->all());
    }
}
