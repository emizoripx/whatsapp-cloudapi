<?php

namespace EmizorIpx\WhatsappCloudapi\Components\Body;

class Body {


    public static function createTextBodyParameter( $text_value  ){

        $text_body_parameter = new BodyParameter( BodyParameter::BODY_PARAMETERS_TEXT_TYPE, $text_value );

        return $text_body_parameter->getBodyParameterData();

    }

    public static function createCurrencyBodyParameter( $fallback_value, $currency_code, $amount_100 ) {
        
    }


    public static function createDateTimeParameter( $fallback_value) {

    }

}