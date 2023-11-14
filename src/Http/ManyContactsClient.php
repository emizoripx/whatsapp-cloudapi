<?php

namespace EmizorIpx\WhatsappCloudapi\Http;

use EmizorIpx\WhatsappCloudapi\Request\ManyContacts\Request;
use EmizorIpx\WhatsappCloudapi\Response\Response;

class ManyContactsClient
{
    const API_VERSION = 'v1';

    protected $client_handler;

    public function __construct()
    {
        $this->client_handler = $this->defaultHandler();
    }

    public function sendRequest(Request $request)
    {
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

    private function defaultHandler(): GuzzleClientHandler
    {
        return new GuzzleClientHandler();
    }

    private function getHost(): ?string
    {
        return config('whatsappcloudapi.manycontacts_api_host');
    }

    private function buildRequestUri(Request $request): string
    {
        return $this->getHost() . '/' . static::API_VERSION . '/' . $request->getUri();
    }
}
