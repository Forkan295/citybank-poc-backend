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
            "account_no"     => $this->account_no,
            "routing_number" => $this->routing_number,
            "name"           => $this->name,
            "bank_name"      => $this->bank_name,
            "branch_name"    => $this->branch_name,
            "branch_city"    => $this->branch_city,
            "currency"       => $this->currency,
        ];
    }
}
