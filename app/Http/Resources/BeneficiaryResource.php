<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "account_name" => data_get($this, 'account_name', ''),
            "account_no"   => data_get($this, 'account_no', ''),
            "bank_name"    => data_get($this, 'bank_name', ''),
            "branch_name"  => data_get($this, 'branch_name', ''),
            "branch_city"  => data_get($this, 'branch_city', ''),
            "currency"     => data_get($this, 'currency', ''),
            "routing_no"   => data_get($this, 'routing_number', ''),
        ];
    }
}
