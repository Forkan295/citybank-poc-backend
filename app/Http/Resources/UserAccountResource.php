<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'accountNo' => $this->account_no,
            'accountType' => $this->accountTypeName,
            'dateOpened' => $this->date_opened,
            'balance' => $this->balance,
        ];
    }
}
