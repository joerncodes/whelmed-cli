<?php

namespace WhelmedCli\Command;

use GuzzleHttp\Client as Guzzle;
use WhelmedCli\Color;

abstract class AbstractCommand 
{
    protected $color;

    public function color() {
        if($this->color === null)
        {
            $this->color = new Color();
        }

        return $this->color;
    }

    protected function request($url, $method = 'GET', $payload = [])
    {
        $url = getenv('BASE_URL') . $url;

        if($method == 'GET') {
            $client = new Guzzle();
            $result = $client->request($method, $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . getenv('API_TOKEN')
                ]
            ]);
        } elseif ($method == 'PATCH') {
            $client = new Guzzle();
            $headers = [ 'Authorization' => 'Bearer ' . getenv('API_TOKEN')];
            $headers = array_merge($headers, $payload);
            $result = $client->request($method, $url, [
                'headers' => $headers
            ]);
             
        } else {
            $client = new Guzzle();
            $result = $client->request($method, $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . getenv('API_TOKEN')
                ],
                'form_params' => $payload
            ]);
        }
        return json_decode((string)$result->getBody());
    }
}
