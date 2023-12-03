<?php

namespace App\Observers;

use App\Models\Invoice;
use App\Notifications\InvoiceCreated;
use Illuminate\Support\Facades\Notification;

class InvoiceObserver
{
    public function created(Invoice $invoice): void
    {
        Notification::route('mail', $invoice->user->email)
                    ->notify(new InvoiceCreated($invoice));
    }
}
