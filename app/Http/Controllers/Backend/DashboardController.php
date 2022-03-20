<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
    	$totalOauth2Admin = $this->getUserByRole('oauth')->count();
    	$totalApiAdmin = $this->getUserByRole('api')->count();
    	$totalBankClient = $this->getUserByRole('bank_client')->count();

    	$totalUser = $totalApiAdmin + $totalOauth2Admin + $totalBankClient;
    	
    	$users = $this->getUserByRole('bank_client')
    					->latest()
    					->take(10)
    					->get();

    	return view('dashboard', compact('users', 'totalOauth2Admin', 'totalApiAdmin', 'totalBankClient', 'totalUser'));
    }

    private function getUserByRole($role)
    {
    	return User::where('role', $role);
    }
}
