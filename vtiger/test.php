<?php

include 'vendor/autoload.php';

use Vdespa\Vtiger\WSClient;

$url = 'https://dci.od2.vtiger.com/';

$config = [
    'auth' => [
        'username' => 'itei.test7@gmail.com',
        'accesskey' => 'Nkli2eUXYxOnKl8'
    ]
];

$wsclient = new WSClient($url, $config);

$create = $wsclient->createObject('Contacts',     array(
        'firstname' => 'Sumo',
        'lastname' => 'Coders',
        'email' => 'sumocoders12@example.com',
        'phone'	=> '9685799403',
        'mobile' => '9685799403'
    ));

echo "Error: " . $wsclient->getLastError() . "<br>";

print_r($create);