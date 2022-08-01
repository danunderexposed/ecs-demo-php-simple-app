<?php

namespace App\Utilities;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class WordpressAPI
{
    /**
     * Wordpress api
     */
    protected Client $api;
    protected string $baseUrl;

    /**
     * Constructor
     */
    public function __construct(string $baseUrl, string $user, string $pass)
    {
        $this->baseUrl = $baseUrl;
        $this->api = new Client([
            'base_url' => $baseUrl,
            'auth' => [
                $user,
                $pass
            ]
        ]);
    }

    public function media(int $id)
    {
        return json_decode($this->api->post($this->baseUrl . 'media/' . $id)->getBody()->getContents());
    }

}
