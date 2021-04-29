<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
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

    'google' => [
        'client_id' => '41760991434-mhet0cvos66nhk5kie33o99cs1ihiatn.apps.googleusercontent.com',
        'client_secret' => 'UoQfNwKfcfMUV_5ryYziRsQ-',
        'redirect' => 'http://localhost/ariaynMtliAuth/google/callback',
    ],


    'facebook' => [

        'client_id' => '466019924652190',

        'client_secret' => '42d6d7bd6e1ba4302b7acd2e10d488bc',

        'redirect' => 'http://localhost/ariaynMtliAuth/facebook/callback',

    ],
];
