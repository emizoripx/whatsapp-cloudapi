<?php

namespace EmizorIpx\WhatsappCloudapi\Messages\ManyContacts;

abstract class Message
{
    protected $number_phone;

    public function __construct(string $number_phone)
    {
        $this->number_phone = $number_phone;
    }

    public function getNumberPhone(): string
    {
        return $this->number_phone;
    }
}
