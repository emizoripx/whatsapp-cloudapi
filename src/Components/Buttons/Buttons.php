<?php

namespace EmizorIpx\WhatsappCloudapi\Components\Buttons;

class Buttons {


    public static function createUrlButton( int $index, $uri_path = null ){

        $array_parameters = is_null($uri_path) ? [] :  [
            "type" => "text",
            "text" => $uri_path
        ];

        $url_button = new Button(Button::URL_TYPE_BUTTON, $index, $array_parameters);

        \Log::debug("URL Button:  ", [$url_button->getButtonData()]);

        return $url_button->getButtonData();

    }


    public static function createQuickReplyButton( int $index, $payload ) {

        $array_parameters = [
            "type" => "payload",
            "payload" => $payload
        ];

        $quick_reply_button = new Button(Button::QUICK_REPLY_TYPE_BUTTON, $index, $array_parameters);

        return $quick_reply_button->getButtonData();

    }

}