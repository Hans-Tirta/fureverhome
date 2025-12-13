<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Midtrans Server Key
    |--------------------------------------------------------------------------
    |
    | Your Midtrans server key for authentication.
    | Get this from Midtrans Dashboard > Settings > Access Keys
    |
    */

    'server_key' => env('MIDTRANS_SERVER_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Client Key
    |--------------------------------------------------------------------------
    |
    | Your Midtrans client key for Snap integration.
    | Get this from Midtrans Dashboard > Settings > Access Keys
    |
    */

    'client_key' => env('MIDTRANS_CLIENT_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Midtrans Environment
    |--------------------------------------------------------------------------
    |
    | Set to false for Sandbox/Development environment
    | Set to true for Production environment
    |
    */

    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    /*
    |--------------------------------------------------------------------------
    | Sanitize Input
    |--------------------------------------------------------------------------
    |
    | Enable sanitization of input parameters
    |
    */

    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),

    /*
    |--------------------------------------------------------------------------
    | Enable 3D Secure
    |--------------------------------------------------------------------------
    |
    | Enable 3D Secure authentication for credit card transactions
    |
    */

    'is_3ds' => env('MIDTRANS_IS_3DS', true),

];
