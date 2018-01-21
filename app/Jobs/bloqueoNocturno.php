<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase;

use Carbon\Carbon;

class bloqueoNocturno implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      //
      // js basa sus fechas en el 01 jun 1970 a las 0:00:00
      // carbon tambien basa sus fechas en el 01 jun 1970 a las 0:00:00

       $today = ((Carbon::now(-5)->timestamp) * 1000);


       $amonthago = ((Carbon::now(-5)->subMonth()->timestamp) * 1000);

       //return(dd($amonthago));

       $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/felipe-29121-firebase-adminsdk-pdax3-dfcd8673d9.json');
       $firebase = (new Factory)
           ->withServiceAccount($serviceAccount)
           ->create();

       $database = $firebase->getDatabase();

       $reference = $database->getReference('usuarios')->orderByChild('vencimiento')->startAt($amonthago)->endAt($today)
       ->getSnapshot();

       $bloqueo = [
         'bloqueo' => 1,
       ];

       foreach($reference->getvalue() as $ref) {

       $uid = $ref['id'];

       $database->getReference('usuarios/'.$uid) // this is the root reference
        ->update($bloqueo);

       }


    }
}
