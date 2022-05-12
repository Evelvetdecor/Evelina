<?php
 
require_once('WebToPay.php');
 
function getSelfUrl(): string
{
    $url = substr(strtolower($_SERVER['SERVER_PROTOCOL']), 0, strpos($_SERVER['SERVER_PROTOCOL'], '/'));
 
    if (isset($_SERVER['HTTPS']) === true) {
        $url .= ($_SERVER['HTTPS'] === 'on') ? 's' : '';
    }
 
    $url .= '://' . $_SERVER['HTTP_HOST'];
 
    if (isset($_SERVER['SERVER_PORT']) === true && $_SERVER['SERVER_PORT'] !== '80') {
        $url .= ':' . $_SERVER['SERVER_PORT'];
    }
 
    $url .= dirname($_SERVER['SCRIPT_NAME']);
 
    return $url;
}
 
try {
     WebToPay::redirectToPayment([
        'projectid' => {YOUR_PROJECT_ID},
        'sign_password' => {YOUR_PROJECT_PASSWORD},
        'orderid' => 0,
        'amount' => 1000,
        'currency' => 'EUR',
        'country' => 'LT',
        'accepturl' => getSelfUrl() . '/accept.php',
        'cancelurl' => getSelfUrl() . '/cancel.php',
        'callbackurl' => getSelfUrl() . '/callback.php',
        'test' => 0,
    ]);
} catch (Exception $exception) {
    echo get_class($exception) . ':' . $exception->getMessage();
}
