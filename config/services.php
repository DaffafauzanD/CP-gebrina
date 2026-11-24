<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    /**
     * Google tag untuk Google Ads (format "AW-XXXXXXXXXX"). Kosongkan di lokal
     * supaya kunjungan saat development tidak tercatat di akun Ads.
     *
     * 'conversions' berisi nilai send_to tiap conversion action (format
     * "AW-XXXXXXXXXX/label"), dikirim saat pengunjung mengklik link WhatsApp
     * atau telepon. Conversion yang kosong tidak dilacak.
     *
     * @var array{id: ?string, conversions: array{whatsapp: ?string, phone: ?string}}
     */
    'google_tag' => [
        'id' => env('GOOGLE_TAG_ID'),
        'conversions' => [
            'whatsapp' => env('GOOGLE_ADS_CONVERSION_WHATSAPP'),
            'phone' => env('GOOGLE_ADS_CONVERSION_PHONE'),
        ],
    ],

    /**
     * Container Google Tag Manager (format "GTM-XXXXXXX"). Tag di dalamnya
     * (Analytics, pixel, dll.) dikelola dari tagmanager.google.com tanpa
     * mengubah kode. Kosongkan di lokal.
     *
     * @var array{id: ?string}
     */
    'google_tag_manager' => [
        'id' => env('GOOGLE_TAG_MANAGER_ID'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
