<?php
$url = 'http://services.groupkt.com/country/get/all';

$process = curl_init($url);
curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($process);
$results = json_decode($response);
var_dump($results->RestResponse->result);
curl_close($process);
