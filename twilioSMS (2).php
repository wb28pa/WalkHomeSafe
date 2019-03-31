<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$account_sid = 'ACc939ba2749875081b8731e92d592de1e';
$auth_token = '13aa043a976486fb857a627b985a245f';


$twilio_number = "+17706298244";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    '+17706560044',
    array(
        'from' => $twilio_number,
        'body' => 'This is (name), I didn\'t get home on time. I may be in trouble. Contact me immediately or seek for help!'
    )
);
