<?php

if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', 'http://localhost:8080/sslcvue'); // Replace this value with your project path
}

if (!defined('API_DOMAIN_URL')) {
    define('API_DOMAIN_URL', 'https://sandbox.sslcommerz.com');
    // define('API_DOMAIN_URL', 'https://securepay.sslcommerz.com');
}

if (!defined('STORE_ID')) {
    define('STORE_ID', 'testbox');
}

if (!defined('STORE_PASSWORD')) {
    define('STORE_PASSWORD', 'qwerty');
}

if (!defined('IS_LOCALHOST')) {
    define('IS_LOCALHOST', true);
}

return [
    'projectPath' => constant("PROJECT_PATH"),
    'apiDomain' => constant("API_DOMAIN_URL"),
    'apiCredentials' => [
        'store_id' => constant("STORE_ID"),
        'store_password' => constant("STORE_PASSWORD"),
    ],
    'apiUrl' => [
        'make_payment' => "/gwprocess/v4/api.php",
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
    ],
    'connect_from_localhost' => constant("IS_LOCALHOST"),
    'success_url' => 'page/success.php',
    'failed_url' => 'page/fail.php',
    'cancel_url' => 'page/cancel.php',
    'ipn_url' => 'page/ipn.php'
];
