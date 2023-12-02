<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_number' => [
                'required',
                'unique:invoices,order_number',
                'string',
                'size:9',
            ],
            'amount'       => [
                'required',
                'numeric',
                'gt:0',
            ],
            'issue_date'   => [
                'required',
                'date',
                'before_or_equal:now',
            ],
            'sender_cnpj'  => [
                'required',
                'string',
                'regex:/([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})/',
            ],
            'sender_name'  => [
                'required',
                'string',
                'max:100',
            ],
            'carrier_cnpj' => [
                'required',
                'string',
                'regex:/([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})/',
            ],
            'carrier_name' => [
                'required',
                'string',
                'max:100',
            ],
        ];
    }
}
