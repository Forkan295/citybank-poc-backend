<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OauthClient;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
    	$totalBankAdmin = $this->getUserByRole(1)->count();
    	$totalBankClient = $this->getUserByRole(2)->count();
    	$totalOauth2Client = OauthClient::get()->count();
    	
    	$totalBankUser = $totalBankAdmin + $totalBankClient + $totalOauth2Client;
    	
    	$users = $this->getUserByRole(2)
    					->latest()
    					->take(10)
    					->get();

    	return view('dashboard', compact('users', 'totalBankAdmin', 'totalBankClient', 'totalBankUser', 'totalOauth2Client'));
    }

    private function getUserByRole($role)
    {
    	return User::where('role', $role);
    }
}
