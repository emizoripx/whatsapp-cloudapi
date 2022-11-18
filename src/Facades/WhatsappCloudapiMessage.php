<?php


namespace EmizorIpx\WhatsappCloudapi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string|array sendMessageWithTemplate( WhatsappCloudApiSettings ,$settings, string $phone_number, string $template_name, Component $components)
 */

 class WhatsappCloudapiMessage extends Facade {


    protected static function getFacadeAccessor()
    {
        return 'send_whatsapp_message';
    }

 }