<?php

namespace EmizorIpx\WhatsappCloudapi\Messages\Template;

interface BaseTemplateDataInterface {

    public static function makeButtons( $data );

    public static function makeHeader( $data );

    public static function makeBody( $data );
}