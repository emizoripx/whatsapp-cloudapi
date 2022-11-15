<?php

namespace EmizorIpx\WhatsappCloudapi\Messages;

abstract class Message {

    protected $messaging_product = 'whatsapp';

    protected $recipient_type = 'individual';

    protected $number_phone;

    protected $type;

    public function __construct( string $number_phone )
    {

        $this->number_phone = $number_phone;
        
    }

    /**
     * Return the phone number for the person you want to send a message to.
     * @return string
     */
    public function getNumberPhone() : string {
        return $this->number_phone;
    }

    /**
     * Return the type of message object.
     * @return string
     */
    public function getType(): string{
        return $this->type;
    }

    /**
     * Return the messaging product.
     * @return string
     */
    public function getMessagingProduct(): string{
        return $this->messaging_product;
    }

    /**
     * Return the recipient type.
     * @return string
     */
    public function getRecipientType():string {
        return $this->recipient_type;
    }

}