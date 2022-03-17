<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\AccountType;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::with('accounts')->paginate();

    	return view('users.index', compact('users'));
    }

    public function create()
    {
    	$roles = User::$role;
    	$accountTypes = AccountType::all();

    	return view('users.create', compact('roles', 'accountTypes'));
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'name' => 'required',
    		'email' => 'required|email|unique:users,email',
    		'phone' => 'required',
    		'role' => 'required',
    		'account_type' => 'required',
    		'account_no' => 'required|integer|unique:accounts,account_no',
    		'balance' => 'nullable|integer',
    		'status' => 'required',
    		'password' => 'required|min:4|confirmed',
    		'password_confirmation' => 'required|min:4',
    	]);

    	DB::beginTransaction();

    	try {
    		$data = [
    			'uuid' => Str::uuid(),
    			'name' => $request->name,
	    		'email' => $request->email,
	    		'phone' => $request->phone,
	    		'role' => $request->role,
	    		'address' => $request->address,
	    		'password' => Hash::make($request->password),
    		];

    		$accountData = [
    			'account_no' => $request->account_no,
    			'type_id' => $request->account_type,
    			'opening_date' => date('Y-m-d'),
    			'balance' => $request->balance ?? 0.00,
    			'is_primary_account' => $request->is_primary ?? 0,
    			'status' => $request->status,
    		];

    		$user = User::create($data);
    		$user->accounts()->create($accountData);
    		DB::commit();

    		return redirect()->back()->with('success', 'Account succssfully created!');
    	} catch (\Exception $e) {
    		DB::rollback();

    		return redirect()->back()->with('error', 'Something went wrong.');
    	}
    }

    public function edit(User $user)
    {
    	$roles = User::$role;
    	$accountTypes = AccountType::all();

    	return view('users.edit', compact('user', 'roles', 'accountTypes'));
    }

    public function update(Request $request, User $user)
    {
    	$request->validate([
    		'name' => 'required',
    		'email' => 'required|email|unique:users,email,'.$user->id,
    		'phone' => 'required',
    		'role' => 'required',
    		'password' => 'required|min:4|confirmed',
    		'password_confirmation' => 'required|min:4',
    	]);

    	try {
    		$data = [
    			'name' => $request->name,
	    		'email' => $request->email,
	    		'phone' => $request->phone,
	    		'role' => $request->role,
	    		'address' => $request->address,
	    		'password' => Hash::make($request->password),
    		];

    		$user->update($data);

    		return redirect()->back()->with('success', 'Account succssfully updated!');
    	} catch (\Exception $e) {
    		DB::rollback();

    		return redirect()->back()->with('error', 'Something went wrong.');
    	}
    }
}
