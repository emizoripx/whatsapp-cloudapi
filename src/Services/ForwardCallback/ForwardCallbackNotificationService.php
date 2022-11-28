<?php

namespace EmizorIpx\WhatsappCloudapi\Services\ForwardCallback;

use EmizorIpx\WhatsappCloudapi\Http\GuzzleClientHandler;
use Exception;
use GuzzleHttp\Exception\RequestException;

class ForwardCallbackNotificationService {

    protected $client;

    protected $data;

    protected $url_to_notification;

    protected $header = [];


    public function __construct( $url_to_notification, $data )
    {

        $this->url_to_notification = $url_to_notification;

        $this->data = json_encode($data);

        $this->header['Content-Type'] = 'application/json';

        $this->client = new GuzzleClientHandler();
        
    }

    public function forwardCallback() {

        try {

            \Log::debug("Forward notification to: " . $this->url_to_notification);
            \Log::debug("Data to forward: " . $this->data);
            \Log::debug("Headers to forward: " . json_encode($this->header));

            $response = $this->client->send($this->url_to_notification, $this->data, $this->header);

            \Log::debug("Reponse Forward: " . json_encode (json_decode( $response->getBody(), true )) );

        } catch( RequestException $rex ) {

            \Log::debug("Error de conexión al enviar el callback ". $rex->getResponse()->getBody());

            throw new Exception( $rex->getResponse()->getBody());

        } catch( Exception $ex ) {

            \Log::debug("Ocurrio un excepción al enviar el Mensaje: " . $ex->getMessage() . ' File: ' . $ex->getFile() . ' Line: ' . $ex->getLine());

            throw new Exception($ex->getMessage());

        }


    }



}