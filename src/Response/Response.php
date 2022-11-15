<?php

namespace EmizorIpx\WhatsappCloudapi\Response;

use EmizorIpx\WhatsappCloudapi\Exceptions\ResponseWhatsappCloudapiException;
use EmizorIpx\WhatsappCloudapi\Request\Request;

class Response {


    protected $http_status_code;

    protected $headers;

    protected $body;

    protected $decoded_body = [];

    protected $request;


    public function __construct( Request $request, $body, $http_status_code = null, array $headers = [] ) 
    {
        $this->request = $request;
        $this->body = $body;
        $this->http_status_code = $http_status_code;
        $this->headers = $headers;

        $this->decodeBody();
        
    }

    public function isError(){

        return isset($this->decoded_body['error']);
    }

    public function getRequest() {

        return $this->request;
    }

    public function getHttpStatusCode(){

        return $this->http_response_code;
    }

    public function getHeaders() {
        
        return $this->headers;
    }

    public function getBody(){

        return $this->body;
    }

    public function getDecodedBody() {

        return $this->decoded_body;
        
    }

    public function graphVersion(){
        return $this->headers['facebook-api-version'] ?? null;
    }

    public function throwException(){

        \Log::debug("Throw Response Exception >>>>>>>>>>>>>>>>>>> ");
        return new ResponseWhatsappCloudapiException($this);
    }


    public function decodeBody() {

        $this->decoded_body = json_decode( $this->body, true );

        if ($this->decoded_body === null) {
            $this->decoded_body = [];
            parse_str($this->body, $this->decoded_body);
        } elseif (is_numeric($this->decoded_body)) {
            $this->decoded_body = ['id' => $this->decoded_body];
        }

        if (!is_array($this->decoded_body)) {
            $this->decoded_body = [];
        }

        if( $this->isError() ) {
            $this->throwException();
        }
    }

}