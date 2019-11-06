<?php

namespace App\Mail;

use App\PurchaseOrders;
use App\Shipment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    protected $shipment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Shipment $shipment)
    {
        $this->shipment = $shipment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sales@PVEL.com', 'PVEL')->subject("Nouvelle commande reçu")
            ->view('mail.NewOrder')->with("shipment", $this->shipment);
    }
}
