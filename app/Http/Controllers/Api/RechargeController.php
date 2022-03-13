<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RechargeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Response\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Enums\MessageEnum;
use App\Models\Account;
use App\Models\User;

class RechargeController extends Controller
{
	public $userId;

	public $userAccount;

	public $currentBalance;

	public function __construct()
	{
		$this->userId = $this->getUserId();

		$this->userAccount = $this->getUserAccount();

		$this->currentBalance = $this->getUserCurrentBalance();
	}

    public function recharge(RechargeRequest $request)
    {
    	if (! $this->userAccount) {
    		return app(ApiResponse::class)->error(MessageEnum::NO_ACCOUNT);
    	}

    	$checkBalance = $request->checkUserBalance($this->currentBalance, $request->recharge_amount);

    	if ($checkBalance) {
    		return app(ApiResponse::class)->error(MessageEnum::NO_BALANCE);
    	}
    	
    	DB::beginTransaction();

    	try {
	    	$data = [
	    		'user_id' => $this->userId,
	    		'account_id' => $this->userAccount->id,
	    		'amount' => $request->recharge_amount,
	    		'type' => 'recharge',
	    		'description' => 'Recharge',
	    	];

    		$transaction = Transaction::create($data);

    		$recharge = [
    			'operator_name' => $request->operator_name,
		    	'phone_number' => $request->phone_number,
		    	'recharge_amount' => $request->recharge_amount,
		    	'status' => true,
    		];

    		$transaction->recharges()->create($recharge);

    		// Account balance update after recharge!
    		$balance = $this->currentBalance - $request->recharge_amount;

    		$transaction->account()->update([
    			'balance' => $balance
    		]);
    		
    		DB::commit();

    		return app(ApiResponse::class)->success([
    			'message' => MessageEnum::SUCCESS_RECHARGE
    		]);
    	} catch (\Exception $e) {
		    DB::rollback();

		    return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
		}
    }

    protected function getUserId()
    {
    	return auth('api')->user()->id;
    }
    
    protected function getUserAccount()
    {
    	$userAccount = Account::where('user_id', $this->userId)
    						->isPrimaryAccount()
    						->first();

    	return $userAccount;
    }

    private function getUserCurrentBalance()
    {
    	return $this->userAccount ? $this->userAccount->balance : 0;
    }
}
