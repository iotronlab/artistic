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
        'client_id' => '667895825276-ssk3fkah9oc2dhm441aait5d96rmmao9.apps.googleusercontent.com',
        'client_secret' => 'XH1A8krfIDoHhWlxndd9WNo_',
        'redirect' => 'http://localhost:8000/api/login/google/callback',
    ],

    'facebook' => [
        'client_id' => '442196260524362',
        'client_secret' => 'fa2b444781bd9513a9503e40d480b005',
        'redirect' => 'http://localhost:8000/api/login/facebook/callback',
    ],
];
