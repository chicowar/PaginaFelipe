<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'maps' => [
            'api-key' => env('GOOGLE_MAPS_API_KEY'),
        ],
    ],

    'firebase' => [
     "apiKey" => "AIzaSyD7fnd4lstP7klHMW8kpGFAtI0iYWWcodg", // Only used for JS integration
     "authDomain" => "felipe-29121.firebaseapp.com", // Only used for JS integration
     "databaseURL" => "https://felipe-29121.firebaseio.com",
     'secret' => "Ukl7V5gUVzUhHiATKEjAiRnvibqxKuhUY28VWELS",
     "project_id" => "felipe-29121",
     "projectId" => "felipe-29121",
     "storageBucket" => "felipe-29121.appspot.com", // Only used for JS integration
     "messagingSenderId" => "428661649011",
     "client_email" => "beyou.solyfel@gmail.com",
     "client_id" => "",
     "private_key" => ""


      ]
];
