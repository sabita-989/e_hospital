<?php

$args = http_build_query(array(
    'token' => $_POST['token'],
    'amount' => $_POST['amount'],
));

$url = "https://khalti.com/api/v2/payment/verify/";

# Make the call using API.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$headers = ['Authorization: Key test_secret_key_e8761f7dbc294a548785a30f030ec59c'];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Response
$response = curl_exec($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo $response;

