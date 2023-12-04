<?php

namespace App\Notifications;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Carbon\Carbon;
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
        $invoice = [
            'order_number' => $this->invoice->order_number,
            'amount'       => "R$ " . round($this->invoice->amount, 2),
            'issue_date'   => Carbon::parse($this->invoice->issue_date)->format('d/m/Y'),
            'sender_cnpj'  => $this->invoice->sender_cnpj_formatted,
            'sender_name'  => $this->invoice->sender_name,
            'carrier_cnpj' => $this->invoice->carrier_cnpj_formatted,
            'carrier_name' => $this->invoice->carrier_name,
        ];

        return (new MailMessage)
            ->subject($subject)
            ->markdown('emails.invoice-created', ['invoice' => $invoice]);
    }
}
