<?php

namespace EmizorIpx\WhatsappCloudapi\Components\Body;

class BodyParameter {

    protected $type;

    protected $parameters;

    protected $builded_body_parameter;

    const BODY_PARAMETERS_TEXT_TYPE = 'text';

    const BODY_PARAMETERS_CURRENCY_TYPE = 'currency';

    const BODY_PARAMETERS_DATE_TIME_TYPE = 'date_time';

    public function __construct( $type, $parameters )
    {
        $this->type = $type;

        $this->parameters = $parameters;

        $this->makeBodyParameter();
        
    }

    public function getBodyParameterData() {

        return $this->builded_body_parameter;
    }

    public function makeBodyParameter(){

        $this->builded_body_parameter = [
            "type" => $this->type,
            "$this->type" => $this->parameters
        ];

    }
}