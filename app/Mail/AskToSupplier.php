<?php

namespace App\Mail;

use App\PurchaseOrders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AskToSupplier extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $text)
    {
        $this->text = $text;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@PVEL.com', 'PVEL')->subject("Un client pose une question")
            ->view('mail.AskToSupplier')
            ->with('name', $this->name)->with('email', $this->email)->with('text', $this->text);
    }
}
