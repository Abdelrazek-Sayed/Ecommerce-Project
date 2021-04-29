<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

   public  $order;
   public  $name;
   public  $email;
    public function __construct($order,$name,$email)
    {
      $this->order = $order;
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

        return $this->from('EcoWeb@bezo.com')->view('admin.mail.invoiceMail')->subject('Invoice');
    }
}
