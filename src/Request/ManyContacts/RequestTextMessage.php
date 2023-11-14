<?php

namespace EmizorIpx\WhatsappCloudapi\Request\ManyContacts;

class RequestTextMessage extends Request
{
    const URI = 'message/text';

    protected function makeBody(): void
    {
        $this->body = [
            'number' => $this->message->getNumberPhone(),
            'text' => $this->message->getText()
        ];
    }
}
