<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Account;

class RechargeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->operator_name == 'grameenphone') {
            $rules = ['required', 'digits:11', 'regex:/^((017)|(013))\d{8}$/'];
        } elseif ($this->operator_name == 'banglalink') {
            $rules = ['required', 'digits:11', 'regex:/^((019)|(014))\d{8}$/'];
        } elseif ($this->operator_name == 'airtel') {
            $rules = ['required', 'digits:11', 'regex:/^016\d{8}$/'];
        } elseif ($this->operator_name == 'robi') {
            $rules = ['required', 'digits:11', 'regex:/^018\d{8}$/'];
        } elseif ($this->operator_name == 'teletalk') {
            $rules = ['required', 'digits:11', 'regex:/^015\d{8}$/'];
        } else {
            $rules = [];
        }

        return [
            'operator_name' => [
                'required', 
                'string', 
                Rule::in(['grameenphone', 'banglalink', 'airtel', 'robi', 'teletalk'])
            ],
            'phone_number' => $rules,
            'recharge_amount' => ['required', 'integer', 'min:10', 'max:1000'],
        ];
    }


    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($factory) {
        $userId = auth('api')->user()->id;

        $userAccount = Account::where('user_id', $userId)
                                ->first();

        $factory->after(function ($factory) use ($userAccount) {
            $balance = (int) $userAccount->balance - $this->recharge_amount;

            if ($balance < 0 || $this->recharge_amount > $userAccount->balance) {
                $factory->errors()->add('message', 'You have no sufficient balance!');
            }
        });

        return $factory;
    }
}
