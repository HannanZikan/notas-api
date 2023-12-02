<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount'       => [
                'sometimes',
                'numeric',
                'gt:0',
            ],
            'issue_date'   => [
                'sometimes',
                'date',
                'before_or_equal:now',
            ],
            'sender_cnpj'  => [
                'sometimes',
                'string',
                'regex:/([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})/',
            ],
            'sender_name'  => [
                'sometimes',
                'string',
                'max:100',
            ],
            'carrier_cnpj' => [
                'sometimes',
                'string',
                'regex:/([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})/',
            ],
            'carrier_name' => [
                'sometimes',
                'string',
                'max:100',
            ],
        ];
    }
}
