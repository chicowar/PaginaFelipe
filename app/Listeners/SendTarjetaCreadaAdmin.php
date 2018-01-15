<?php

namespace App\Listeners;
use Mail;
use App\Events\TarjetaWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\TarjetaCreadaAdmin;

class SendTarjetaCreadaAdmin implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TarjetaWasCreated  $event
     * @return void
     */
    public function handle(TarjetaWasCreated $event)
    {
        //
        //dd($event->user);
        Mail::to($event->user)->send(new TarjetaCreadaAdmin($event->tarjeta));

    }
}
