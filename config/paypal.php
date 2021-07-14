<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_API_MODE', ''), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => env('PAYPAL_API_USERNAME', 'business_api1.xoho.tech'),
        'password'    => env('PAYPAL_API_PASSWORD', 'QNDB5535VJG4DPV5'),
        'secret'      => env('PAYPAL_API_SECRET', 'AiPC9BjkCyDFQXbSkoZcgqH3hpacAEs1kwIPjNwpI9gCogTBtj0JkKoJ'),
        'certificate' => env('PAYPAL_API_CERTIFICATE', ''),
        'app_id'      => env('PAYPAL_API_APP_ID', 'APP-80W284485P519543T'), // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => env('PAYPAL_API_USERNAME', 'paypal_api1.ProTek2.com'),
        'password'    => env('PAYPAL_API_PASSWORD', 'CZHUHWN2E4FCAHBZ'),
        'secret'      => env('PAYPAL_API_SECRET', 'AFcWxV21C7fd0v3bYYYRCpSSRl31A5ZKA3Z7gId98fqTjyBTJBGRqNYV'),
        'certificate' => env('PAYPAL_API_CERTIFICATE', ''),
        'app_id'      => env('PAYPAL_API_APP_ID', 'APP-2R596630LE555572N'), // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'USD',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
];
