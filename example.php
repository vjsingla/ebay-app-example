<?php
require __DIR__.'/vendor/autoload.php';

use Ebay\DigitalSignature\Signature;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

$signature = new Signature(__DIR__."/config.json");
$endpoint = 'https://apiz.sandbox.ebay.com/sell/finances/v1/transaction';
$headers = [
    'Authorization'           => 'Bearer v^1.1#i^1#I^3#r^1#p^3#f^0#t^Ul4xMF85OkUxNzdBQ0I5QjE2NjNERTY2ODQ4NTVGODQ3MTE5NDU1XzBfMSNFXjEyODQ=',
    'Accept'                  => 'application/json',
    'Content-Type'            => 'application/json',
];
$body = null;
$method = 'GET';
$headers = $signature->generateSignatureHeaders($headers, $endpoint, $method, $body);

$apiClient = new Client();
try {
    $response = $apiClient->request(
        $method,
        $endpoint,
        [
            'body'    => $body,
            'headers' => $headers,
        ]
    );
    print $response->getBody()->getContents();
} catch (GuzzleException $e) {
    print_r($e->getTrace());
}