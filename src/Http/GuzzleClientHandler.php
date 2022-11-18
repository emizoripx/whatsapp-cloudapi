<?php

namespace EmizorIpx\WhatsappCloudapi\Http;

use GuzzleHttp\Client;

class GuzzleClientHandler {

    protected $guzzle_client ;

    public function __construct( ?Client $guzzle_client = null )
    {
        $this->guzzle_client = $guzzle_client ?: new Client();
        
    }

    public function send( string $url, string $body, array $headers ){

        $response = $this->guzzle_client->post( $url, [
            'body' => $body,
            'headers' => $headers
        ]);

        return $response;

    }

}