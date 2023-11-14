<?php

namespace EmizorIpx\WhatsappCloudapi\Services\Whatsapp;

use EmizorIpx\WhatsappCloudapi\Exceptions\WhatsappCloudapiException;

class ManyContactsService
{

    protected $number_phone;

    protected $api_key;

    protected $prepared_data;

    public function __construct()
    {
        $this->validateSettings();

        $this->client = new Client();
    }

    public function validateSettings(): void
    {

        if (empty(config('whatsappcloudapi.manycontacts_api_host'))) {
            throw new WhatsappCloudapiException('ManyContacts Host no encontrado, se debe configurar en el .ENV');
        }

        if (empty(config('whatsappcloudapi.manycontacts_api_key'))) {
            throw new WhatsappCloudapiException('Api Token requerido');
        }
    }
}
