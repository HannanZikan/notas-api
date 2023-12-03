<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $cnpjMask = '##.###.###/####-##';

        return [
            'order_number' => $this->order_number,
            'amount'       => "R$" . round($this->amount, 2),
            'issue_date'   => Carbon::parse($this->issue_date)->format('d/m/Y'),
            'sender_cnpj'  => $this->sender_cnpj_formatted,
            'sender_name'  => $this->sender_name,
            'carrier_cnpj' => mask($cnpjMask, $this->carrier_cnpj),
            'carrier_name' => $this->carrier_name,
            'user_owner'   => new UserResource($this->whenLoaded('user')),
        ];
    }
}
