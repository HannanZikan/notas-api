<?php

namespace App\Notifications;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public Invoice $invoice;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $subject = "Nota Fiscal " . $this->invoice->order_number . " criada com sucesso!";
        $invoiceResource = new InvoiceResource($this->invoice);

        return (new MailMessage)
            ->subject($subject)
            ->markdown('emails.invoice-created', ['invoice' => $invoiceResource]);
    }
}
