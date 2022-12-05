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

    'facebook' => [
        'client_id' => '813964069853472',  //client face của bạn
        'client_secret' => 'a41b85067352d661f58515595bd66e22',  //client app service face của bạn
        'redirect' => 'http://localhost:8083/LaravelShopbanhang/admin/callback' //callback trả về
    ],

    'google' => [
        'client_id' => '958801178923-skuq9ng2lqcc3vq03f6vk8i3nt91lop1.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8083/LaravelShopbanhang/google/callback'  
    ],



];
