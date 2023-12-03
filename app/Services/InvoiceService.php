<?php

namespace App\Services;

class InvoiceService
{
    public function validateCnpj(string $cnpj): bool
    {
        if (!CnpjService::validateCnpj($cnpj['sender_cnpj'])) {
            return false;
        }
        return true;
    }
}
