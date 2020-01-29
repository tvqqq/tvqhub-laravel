<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HGuzzle
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => storage_path('cacert.pem')
        ]);
    }

    public function send(string $method, string $url, array $dataSend = [])
    {
        $result = null;
        try {
            $response = $this->client->request($method, $url, $dataSend);
            $result = json_decode($response->getBody());
        } catch (GuzzleException $e) {
            logger('Guzzle', [$e->getMessage()]);
        }
        return $result;
    }
}
