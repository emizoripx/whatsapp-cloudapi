<?php

namespace EmizorIpx\WhatsappCloudapi\Services\Whatsapp\Settings;

use Exception;

class WhatsappCloudApiSettings {

    protected $from_phone_number_id;

    protected $access_token;


    public function __construct( string $from_phone_number_id, string $access_token )
    {
        $this->from_phone_number_id = $from_phone_number_id;

        $this->access_token = $access_token;
        
        $this->validate();
    }

    public function getAccessToken() {

        return $this->access_token;
    }


    public function getFromPhoneNumberId() {

        return $this->from_phone_number_id;
    }

    public function validate(){

        if( is_null($this->from_phone_number_id) || empty($this->from_phone_number_id) ) {

            throw new Exception('Phone Number ID Requerido');
        }

        if( is_null($this->access_token) || empty($this->access_token) ) {

            throw new Exception('Acess Token Requerido');
        }

    }


}