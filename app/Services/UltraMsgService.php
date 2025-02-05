<?php

namespace App\Services;

use GuzzleHttp\Client;

class UltraMsgService
{
    protected $client;
    protected $instanceId;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->instanceId = env('ULTRAMSG_INSTANCE_ID');
        $this->apiKey = env('ULTRAMSG_API_KEY');
    }

    public function sendMessage($to, $message)
    {
        $response = $this->client->post("https://api.ultramsg.com/{$this->instanceId}/messages/chat", [
            'form_params' => [
                'token' => $this->apiKey,
                'to' => $to,
                'body' => $message,
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}