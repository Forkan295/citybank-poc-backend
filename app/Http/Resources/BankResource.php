<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        parent::withoutWrapping();

        return [
            'id'   => data_get($this, 'id',),
            'name' => data_get($this, 'name'),
            'code' => data_get($this, 'short_code'),
        ];
    }
}
