<?php

namespace EmizorIpx\WhatsappCloudapi\Response\Abstracts;

abstract class AbstractCallbackResponse
{

    protected $body = [];

    protected $display_phone_number;

    protected $from_phone_number_id;

    protected $statuses_data = [];

    protected $message_id;

    protected $state_message;

    protected $is_billable;

    protected $errors;

    protected $message_errors;

    protected $timestamp;

    /**
     * @var ResponseMessage
     */
    protected $response_message;

    public function __construct(array $data)
    {
        $this->body = $data;

        $this->decodeResponse();
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getDisplayPhoneNumber()
    {

        return $this->display_phone_number;
    }

    public function getFromPhoneNumberId()
    {

        return $this->from_phone_number_id;
    }

    public function getErrors()
    {

        return $this->errors;
    }

    public function getMessageErrors()
    {

        return $this->message_errors;
    }

    public function getStatusesData()
    {

        return $this->statuses_data;
    }

    public function getMessageId()
    {

        return $this->message_id;
    }

    public function getTimestamp()
    {

        return $this->timestamp;
    }

    public function getStateMessage()
    {

        return $this->state_message;
    }

    public function getIsBillable()
    {

        return isset($this->is_billable);
    }

    public function getResponseMessage()
    {

        return $this->response_message;
    }

    abstract public function decodeResponse();
}
