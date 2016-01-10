<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */
    'paypal' => [
        'client_id' => 'AbHIGTH8L_dLYNFNUaV7CYZXdOt4O_d0y2RocHEA-hUl_MF1P3OJF8BaAbxuSeGJ6vPJGdEHexTcBIr0',
        'secret' => 'EJQJRJpai4uLw9LADmSdRxn4PClqznzFgrFVWFKEmxA4dNWCFpSIpUEsYiEO1sZFNrV6U_zLOU6bHCY5'
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'mandrill' => [
        'secret' => env('MANDRILL_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'github' => [
        'client_id' => 'your-github-app-id',
        'client_secret' => 'your-github-app-secret',
        'redirect' => 'http://your-callback-url',
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CONSUMER_KEY'),
        'client_secret' => env('FACEBOOK_CONSUMER_SECRET'),
        'redirect' => env('FACEBOOK_CLIENT_REDIRECT'),
    ],
];
