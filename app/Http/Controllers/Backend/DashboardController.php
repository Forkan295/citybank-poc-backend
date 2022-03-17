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
    	$totalBankAdmin = $this->getUserCountByRole(1);
    	$totalBankClient = $this->getUserCountByRole(2);
    	$totalBankUser = $this->getUserCountByRole(3);
    	$totalOauth2Client = OauthClient::get()->count();
    	
    	$users = User::where('role', 2)->latest()->take(10)->get();

    	return view('dashboard', compact('users', 'totalBankAdmin', 'totalBankClient', 'totalBankUser', 'totalOauth2Client'));
    }

    private function getUserCountByRole($role)
    {
    	return User::where('role', $role)->count();
    }
}
