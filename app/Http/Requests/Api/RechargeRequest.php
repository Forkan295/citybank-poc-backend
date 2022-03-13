<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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


    public function checkUserBalance($currentBalance, $rechargeBalance)
    {
        $restAccountBalance = (int) $currentBalance - $rechargeBalance;

        if ($restAccountBalance <= 20 || $currentBalance <= 20 || $rechargeBalance > $currentBalance) {
            return true;
        }

        return false;
    }
}
