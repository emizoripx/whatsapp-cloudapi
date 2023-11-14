<?php

namespace EmizorIpx\WhatsappCloudapi\Messages\ManyContacts;

class TextMessage extends Message
{
    protected $text;

    public function __construct(string $number_phone, string $text)
    {
        $this->text = $text;

        parent::__construct($number_phone);
    }

    public function getText(): string
    {
        return $this->text;
    }
}
