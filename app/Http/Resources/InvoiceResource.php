<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'order_number' => $this->order_number,
            'amount'       => $this->amount,
            'issue_date'   => $this->issue_date,
            'sender_cnpj'  => $this->sender_cnpj,
            'sender_name'  => $this->sender_name,
            'carrier_cnpj' => $this->carrier_cnpj,
            'carrier_name' => $this->carrier_name,
            'user_owner'   => new UserResource($this->whenLoaded('user')),
        ];
    }
}
