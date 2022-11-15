<?php

namespace EmizorIpx\WhatsappCloudapi\Services\Whatsapp;

use EmizorIpx\WhatsappCloudapi\Exceptions\ResponseWhatsappCloudapiException;
use EmizorIpx\WhatsappCloudapi\Exceptions\WhatsappCloudapiException;
use EmizorIpx\WhatsappCloudapi\Http\Client;
use EmizorIpx\WhatsappCloudapi\Messages\Template\Component;
use EmizorIpx\WhatsappCloudapi\Messages\Template\TemplateMessage;
use EmizorIpx\WhatsappCloudapi\Request\RequestTemplateMessage;
use Exception;
use GuzzleHttp\Exception\RequestException;

class WhatsappService {

    protected $number_phone;

    protected $phone_id_number;

    protected $token;

    protected $client;

    protected $template_name;

    protected $prepared_data;

    protected $parsed_response;


    /**
     * @param string $phone_id_number
     * @param string $token
     * 
     * @return WhastappService
     */
    public function __construct( string $phone_id_number, string $token )
    {

        $this->phone_id_number = $phone_id_number;

        $this->token = $token;

        $this->validateConfigs();

        // $data_client['base_uri'] = config('whatsappcloudapi.whatsapp_cloud_api_host');
        // $data_client['headers']['Authorization'] = 'Bearer ' . $this->token;
        // $data_client['headers']['Content-Type'] = 'application/json';

        $this->client = new Client(config('whatsappcloudapi.cloud_api_version'));
        
    }

    public function validateConfigs() {

        if(empty(config('whatsappcloudapi.whatsapp_cloud_api_host'))){
            throw new WhatsappCloudapiException('Whatsapp Host no encontrado, se debe configurar en el .ENV');
        }

        if(empty($this->token)){
            throw new WhatsappCloudapiException('Token requerido');
        }

    }

    /**
     * @param string $value
     * 
     * @return void
     */
    public function setNumberPhone( $value ) {

        $this->number_phone = $value;

    }

    public function setParsedResponse( $value ){

        $this->parsed_response = $value;

    }

    public function setTemplate( $value ) {

        $this->template_name = $value;

    }

    public function sendTemplateWhatsapp( string $number_phone, string $template_name, Component $components = null ){

        try {

            $message = new TemplateMessage($number_phone, $template_name, $components);
    
            $request = new RequestTemplateMessage($message, $this->token, $this->phone_id_number);
    
            $response = $this->client->sendRequest($request);

            return $response;
            
        } catch( RequestException $rex ) {

            \Log::debug("Error de conexión al enviar el mensaje ". $rex->getResponse()->getBody());

            throw new WhatsappCloudapiException( $rex->getResponse()->getBody(), true );

        } catch( ResponseWhatsappCloudapiException $rsex ) {

            \Log::debug("Error Reponse whatsapp Service: " . $rsex->getResponseData() . ' Staus Code: ' . $rsex->getHttpStatusCode());

            throw new WhatsappCloudapiException(  $rsex->getResponseData(), true );
        

        } catch( Exception $ex ) {

            \Log::debug("Ocurrio un excepción al enviar el Mensaje: " . $ex->getMessage() . ' File: ' . $ex->getFile() . ' Line: ' . $ex->getLine());

            throw new WhatsappCloudapiException($ex->getMessage());

        }


    }

}