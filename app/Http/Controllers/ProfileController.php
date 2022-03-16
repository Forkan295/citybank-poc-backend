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

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
            // 'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:1024',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ];

            $user->update($data);

            // if ($request->hasFile('photo')) {
            //     $request->photo->storeAs('photos', $request->photo);
            // }

            return redirect()->route('profile.index')->with('success', 'Account succssfully updated!');
        } catch (\Exception $e) {
            return redirect()->route('profile.index')->with('error', 'Something went wrong.');
        }
    }
}
