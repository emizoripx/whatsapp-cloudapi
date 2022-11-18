<?php

namespace EmizorIpx\WhatsappCloudapi\Request;

class RequestTemplateMessage extends Request {

    protected function makeBody()
    {
        $this->body = [
            'messaging_product' => $this->message->getMessagingProduct(),
            'recipient_type' => $this->message->getRecipientType(),
            'to' => $this->message->getNumberPhone(),
            'type' => $this->message->getType(),
            'template' => [
                'name' => $this->message->getTemplateName(),
                'language' => ['code' => config('whatsappcloudapi.language_template')],
                'components' => []
            ]
        ];

        if( $this->message->getHeader() ) {

            $this->body['template']['components'][] = [
                'type' => 'header',
                'parameters' => $this->message->getHeader()
            ];
        }

        if( $this->message->getBody() ){
            $this->body['template']['components'][] = [
                'type'  => 'body',
                'parameters' => $this->message->getBody()
            ];
        }

        foreach ($this->message->getButtons() as $button) {
            $this->body['template']['components'][] = $button;
        }
    }

}