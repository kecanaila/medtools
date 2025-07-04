<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendorOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $vendor;
    public $vendorOrders;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order, User $vendor, $vendorOrders)
    {
        $this->order = $order;
        $this->vendor = $vendor;
        $this->vendorOrders = $vendorOrders;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Order Notification - #' . $this->order->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.vendor-order-notification',
            with: [
                'order' => $this->order,
                'vendor' => $this->vendor,
                'vendorOrders' => $this->vendorOrders,
                'customer' => $this->order->user,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
} 