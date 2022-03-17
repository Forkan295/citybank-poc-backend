<?php

namespace App\Http\Controllers\Backend;

use Laravel\Passport\ClientRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankList;
use App\Models\OauthClient;

class ClientController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $clients = $user->clients;

    	return view('client.index', compact('clients'));
    }

    public function create()
    {
    	return view('client.create');
    }

    public function store(Request $request)
    {
        $redirect = null;
        $provider = null;
        $personalAccess = null;
        $password = null;
        $confidential = null;
    	$this->validate($request, [
            'client_type' => 'required',
        ]);
        switch ($request->client_type) {
            case 'pkce':
                $request->validate([
                    'name' => 'required|max:255',
                    'redirect' => 'required|url',
                ]);
                $redirect = $request->redirect;
                $provider = null;
                $personalAccess = false;
                $password = false;
                $confidential = false;
                break;
            case 'password':
                $request->validate([
                    'name' => 'required|max:255',
                ]);
                $redirect = url('/');
                $provider = $request->provider;
                $personalAccess = false;
                $password = true;
                $confidential = true;
                break;
        }
        ClientRepository::create(auth()->user()->id, $request->name, $redirect,$provider,$personalAccess,$password,$confidential);

        return redirect()->back()->with('success', 'Client succssfully created!');
    }
}
