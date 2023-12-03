<?php

namespace App\Policies\Api;

use App\Models\Invoice;
use App\Models\User;

class InvoicePolicy
{
    public function view(User $user, Invoice $invoice): bool
    {
        return $invoice->user_id === $user->id;
    }

    public function update(User $user, Invoice $invoice): bool
    {
        return $invoice->user_id === $user->id;
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        return $invoice->user_id === $user->id;
    }
}
