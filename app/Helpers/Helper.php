<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Helper
{
    /**
     * Make a Guzzle Http
     * @param string $method
     * @param string $url
     * @param array $dataSend
     * @return mixed|null
     */
    public function guzzle(string $method, string $url, array $dataSend = [])
    {
        $result = null;
        $client = new Client([
            'verify' => storage_path('cacert.pem')
        ]);
        try {
            $response = $client->request($method, $url, $dataSend);
            $result = json_decode($response->getBody());
        } catch (GuzzleException $e) {
            logger('Guzzle', [$e->getMessage()]);
        }
        return $result;
    }

    /**
     * Random a hex color
     *
     * @return string
     */
    public function randomHexColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
