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
        'client_id' => '721735602553-4j9094laq0ctap2qp0lo228rlkoo87np.apps.googleusercontent.com',
        'client_secret' => 'G0tMRfj_bv7R7NGrQZUZ0gnJ',
        'redirect' => 'http://localhost:8000/api/login/google/callback',
    ],

    'facebook' => [
        'client_id' => '2434292290158494',
        'client_secret' => 'aabf96d2270ddaaa7b9959bba679ced0',
        'redirect' => 'http://localhost:8000/api/login/facebook/callback',
    ],
];
