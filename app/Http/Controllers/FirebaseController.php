<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    //
    public function index()
{

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

  return(dd($reference));

}

}
