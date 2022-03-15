<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RechargeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Response\ApiResponse;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionType;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Enums\MessageEnum;
use App\Models\Account;
use App\Models\User;

class RechargeController extends Controller
{
	private $userId;
	private $userAccount;
	private $currentBalance;
	private $transactionType;

	public function __construct()
	{
		$this->userId = $this->getUserId();
		$this->userAccount = $this->getUserAccount();
		$this->currentBalance = $this->getUserCurrentBalance();
		$this->transactionType = $this->getTransactionTypeId('recharge');
	}

	/**
	 * [recharge description]
	 * @param  RechargeRequest $request [description]
	 * @return [type]                   [description]
	 */
    public function recharge(RechargeRequest $request)
    {
    	DB::beginTransaction();

    	try {
	    	$data = [
	    		'user_id' => $this->userId,
	    		'account_id' => $this->userAccount->id,
	    		'amount' => $request->recharge_amount,
	    		'type_id' => $this->transactionType,
	    		'description' => 'Recharge',
	    		'status' => true,
	    	];

    		$transaction = Transaction::create($data);

    		$recharge = [
    			'operator_name' => $request->operator_name,
		    	'phone_number' => $request->phone_number,
		    	'recharge_amount' => $request->recharge_amount,
		    	'status' => true,
    		];

    		$transaction->recharge()->create($recharge);

    		// Account balance update after recharge!
    		$balance = $this->currentBalance - $request->recharge_amount;

    		$transaction->account()->update([
    			'balance' => $balance
    		]);
    	
    		$activityLog = [
	    		'account_id' => $this->userAccount->id,
	    		'account_number' => $this->userAccount->account_no,
	    		'type_id' => $this->transactionType,
	    		'type_name' => 'recharge',
	    		'account_balance_before_recharge' => $this->currentBalance,
	    		'account_balance_after_recharge' => $balance,
	    		'recharge_amount' => $request->recharge_amount,
	    		'operator_name' => $request->operator_name,
	    		'phone_number' => $request->phone_number,
	    		'description' => 'Recharge',
	    		'status' => true,
    		];
    		
    		activity('recharge')
    			->withProperties($activityLog)
    			->log('Recharge');

    		DB::commit();

    		return app(ApiResponse::class)->success([
    			'message' => 'You have successfully recharged.'
    		]);
    	} catch (\Exception $e) {
		    DB::rollback();

		    return app(ApiResponse::class)->exception(MessageEnum::SERVER_EXCEPTION);
		}
    }

    /**
     * [getUserId description]
     * @return [type] [int]
     */
    protected function getUserId()
    {
    	// return auth('api')->user()->id;
    }
    
    /**
     * [getUserAccount description]
     * @return [type] [description]
     */
    protected function getUserAccount()
    {
    	$userAccount = Account::where('user_id', $this->userId)
    						->isPrimaryAccount()
    						->first();

    	return $userAccount;
    }

    /**
     * [getUserCurrentBalance description]
     * @return [type] [description]
     */
    private function getUserCurrentBalance()
    {
    	return $this->userAccount ? $this->userAccount->balance : 0;
    }

    /**
     * [getTransactionTypeId description]
     * @param  [string] $typeName [description]
     * @return [int]           [description]
     */
    protected function getTransactionTypeId($typeName)
    {
    	$typeId = TransactionType::where('name', $typeName)
    						->pluck('id')
    						->first();

    	return $typeId;
    }
}
