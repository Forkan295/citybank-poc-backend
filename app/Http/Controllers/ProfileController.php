<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
    	$userId = Auth::user()->id;
    	
    	$user = User::with('accounts', 'beneficiaries', 'transactions')
    				->findOrFail($userId);

    	return view('profile.index', compact('user'));
    }

    public function changePassword(Request $request)
    {
    	$request->validate([
	        'password' => 'required|min:4|confirmed',
	        'password_confirmation' => 'required|min:4',
	    ]);

    	$user = Auth::user();

	    $hasPassword = $user->password;

		if (! Hash::check($request->password, $hasPassword)) {
			$user::where('id', $user->id)
				->update(['password' => Hash::make($request->password)]);

			return redirect()->back()->with('success', 'Your password has been successfully changed!');
		} else {
			return redirect()->back()->with('error', 'New password can not be the old password!');
		}
    }
}
