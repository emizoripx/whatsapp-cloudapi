<?php

namespace EmizorIpx\WhatsappCloudapi\Http;

use EmizorIpx\WhatsappCloudapi\Request\Request;
use EmizorIpx\WhatsappCloudapi\Response\Response;

class Client {

    protected $client_handler;

    protected $graph_version;


    public function __construct( $graph_version)
    {
        $this->graph_version = $graph_version;
        
        $this->client_handler = $this->defaultHandler();

    }

    public function sendRequest( Request $request ){

        \Log::debug("Send to URL: " . $this->buildRequestUri($request));
        \Log::debug("Body to Send: " . $request->getEncodedBody());
        \Log::debug("Headers to Send: " . json_encode($request->getHeaders()));

        $response = $this->client_handler->send(
            $this->buildRequestUri($request),
            $request->getEncodedBody(),
            $request->getHeaders()
        );

        $return_response = new Response($request, $response->getBody(), $response->getStatusCode(), $response->getHeaders());

        if ($return_response->isError()) {
            $return_response->throwException();
        }

        return $return_response;

    }

    private function defaultHandler() {

        return new GuzzleClientHandler();
    }

    private function buildBaseUri(){

        return config('whatsappcloudapi.whatsapp_cloud_api_host') . "/" . config('whatsappcloudapi.cloud_api_version'); 

    }

    private function buildRequestUri ( Request $request ){

        return $this->buildBaseUri() . '/' . $request->getFromPhoneNumberId() . '/messages';

    }

}