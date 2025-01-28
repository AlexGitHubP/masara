<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderDetails, $reference, $cartItems, $carrier, $paymentProvider)
    {
        $this->orderDetails    = $orderDetails;
        $this->reference       = $reference;
        $this->cartItems       = $cartItems;
        $this->carrier         = $carrier;
        $this->paymentProvider = $paymentProvider;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: 'noreply@masara.ro',
            subject: 'Comandă înregistrată cu succes',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        
        return new Content(
            view: 'cart.invoices.clientOrder',
            with: [
                'orderDetails'    => $this->orderDetails,
                'reference'       => $this->reference,
                'cartItems'       => $this->cartItems,
                'carrier'         => $this->carrier,
                'paymentProvider' => $this->paymentProvider
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
