<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RechargeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\User;

class RechargeController extends Controller
{
    public function recharge(RechargeRequest $request)
    {
    	$userId = User::where('email', $request->email)
    					->pluck('id')
    					->first();
    	
    	if (! $userId) {
    		return response()->json([
    				'message' => 'User does not match!'
    			],
    			Response::HTTP_NOT_FOUND);
    	}

    	$userAccount = Account::where('user_id', $userId)
    						->isPrimaryAccount()
    						->first();
    	
    	if (! $userAccount) {
    		return response()->json([
    				'message' => 'You don\'t have primary account!'
    			],
    			Response::HTTP_NOT_FOUND);
    	}

    	$currentBalance = (int) $userAccount->balance;

    	if ($currentBalance < 50 || $request->balance > $currentBalance) {
    		return response()->json(['message' => 'You have no sufficient balance!'], Response::HTTP_NOT_FOUND);
    	} 
    	
    	DB::beginTransaction();

    	try {
	    	$data = [
	    		'user_id' => $userId,
	    		'account_id' => $userAccount->id,
	    		'amount' => $request->balance,
	    		'type' => 'recharge',
	    		'description' => 'Recharge',
	    	];

    		$transaction = Transaction::create($data);

    		$recharge = [
    			'operator_name' => $request->operator_name,
		    	'phone_number' => $request->phone_number,
		    	'balance' => $request->balance,
		    	'status' => true,
    		];

    		$transaction->recharges()->create($recharge);

    		// Account balance update after recharge!
    		$accountBalance = $transaction->account()
    										->pluck('balance')
    										->first();

    		$afterRechargeTotalBalance = $accountBalance - $request->balance;

    		$transaction->account()->update(['balance' => $afterRechargeTotalBalance]);
    		
    		DB::commit();

    		return response()->json(['message' => 'You have successfully recharged.'], Response::HTTP_OK);
    	} catch (\Exception $e) {
		    DB::rollback();
		    throw $e;
		}
    }
}
