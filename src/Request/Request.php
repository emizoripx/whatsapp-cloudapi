<?php

namespace EmizorIpx\WhatsappCloudapi\Request;

use EmizorIpx\WhatsappCloudapi\Messages\Message;

abstract class Request {

    protected $message;

    protected $access_token;

    protected $from_phone_number_id;

    protected $body;

    protected $encoded_body;

    public function __construct( Message $message, string $access_token, string $from_phone_number_id )
    {
        $this->message = $message;
        $this->access_token = $access_token;
        $this->from_phone_number_id = $from_phone_number_id;

        $this->makeBody();
        $this->encodeBody();
    }

    public function getBody() {
        return $this->body;
    }

    /**
     * Returns the body of the request encoded.
     * 
     * @return string
     */
    public function getEncodedBody(){
        return $this->encoded_body;
    }

    /**
     * Return WhatsApp Number Id for this request.
     * @return string
     */
    public function getFromPhoneNumberId(): string {

        return $this->from_phone_number_id;
    }

    /**
     * Return the access token for this request.
     * 
     * @return string
     */
    public function getAccessToken():string {

        return $this->access_token;
    }

    /**
     * Return the headers for this request.
     * 
     * @return array
     */
    public function getHeaders(): array{

        return [
            'Authorization' => "Bearer $this->access_token",
            'Content-Type' => 'application/json',
        ];
    }

    abstract protected function makeBody();


    private function encodeBody() {
        $this->encoded_body = json_encode($this->getBody());
    }

}