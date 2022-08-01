<?php

namespace App\Utilities;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class LegacyHasherAPI
{
    /**
     * Legacy Hasher api
     */
    protected Client $api;
    protected string $baseUrl;

    /**
     * Constructor
     */
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->api = new Client([
            'base_url' => $baseUrl,
            // 'auth' => [
            //     $user,
            //     $pass
            // ]
        ]);
    }

    public function getHash(string $password, string $salt)
    {
        return $this->api->post($this->baseUrl . '?q=' . urlencode($password) . '&salt=' . urlencode($salt))->getBody()->getContents();
    }

}
