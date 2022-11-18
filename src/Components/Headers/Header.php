<?php

namespace EmizorIpx\WhatsappCloudapi\Components\Headers;

class Header {

    protected $type;

    protected $parameters;

    protected $builded_header;

    const IMAGE_HEADER_TYPE = 'image';

    const DOCUMENT_HEADER_TYPE = 'document';

    const TEXT_HEADER_TYPE = 'text';

    public function __construct( $type, $parameters)
    {

        $this->type = $type;

        $this->parameters = $parameters;

        $this->makeHeader();
        
    }

    public function getHeaderData() {

        return $this->builded_header;
    }


    public function makeHeader() {

        $this->builded_header = [
            "type" => $this->type,
            "$this->type" => $this->parameters
        ];

    }

}