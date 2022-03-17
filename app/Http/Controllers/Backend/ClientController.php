<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankList;
use App\Models\OauthClient;

class ClientController extends Controller
{
    public function index()
    {
    	$clients = OauthClient::all();

    	return view('client.index', compact('clients'));
    }

    public function create()
    {
    	return view('client.create');
    }
}
