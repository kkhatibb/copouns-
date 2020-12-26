<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'google' => [
        'client_id'     => env('GOOGLE_CLIENT_ID' , '94112614912-3ijj98vm0731v11nsc3pr6564qbli855.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET' , '9cfl0yXSiVGVywTFz2aW4w7b'),
        'redirect'      => env('GOOGLE_REDIRECT' , 'https://anycouponstore.com/auth/login/google/callback')
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID' , '224209535479392'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET' , '977818ca40750b3e5bfe0cedc9dd8c51'),
        'redirect' =>'https://anycouponstore.com/auth/login/facebook/callback',
    ],

];
