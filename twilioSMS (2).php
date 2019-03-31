<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$account_sid = 'KEY HERE';
$auth_token = 'KEY HERE';


$twilio_number = "+17706298***";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    '+17706560044',
    array(
        'from' => $twilio_number,
        'body' => 'This is (name), I didn\'t get home on time. I may be in trouble. Contact me immediately or seek for help!'
    )
);
