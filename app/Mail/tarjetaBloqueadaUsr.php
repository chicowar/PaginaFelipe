<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class tarjetaBloqueadaUsr extends Mailable
{
    use Queueable, SerializesModels;
  public $ref;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ref)
    {
        //
        $this->ref = $ref;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.tarjeta.bloqueadaUsr')->subject('Tu tarjeta BU ha sido bloqueada')->to($this->ref['email']);;
    }
}
