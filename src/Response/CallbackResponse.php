<?php

namespace EmizorIpx\WhatsappCloudapi\Response;

class CallbackResponse {

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

    public function __construct( array $data )
    {
        $this->body = $data;

        $this->decodeResponse();
    }

    public function getBody() {
        return $this->body;
    }

    public function getDisplayPhoneNumber() {

        return $this->display_phone_number;
    }

    public function getFromPhoneNumberId(){

        return $this->from_phone_number_id;

    }

    public function getErrors() {

        return $this->errors;
    }

    public function getMessageErrors() {

        return $this->message_errors;
    }

    public function getStatusesData(){

        return $this->statuses_data;
    }

    public function getMessageId() {

        return $this->message_id;
    }

    public function getTimestamp() {

        return $this->timestamp;
    }

    public function getStateMessage(){

        return $this->state_message;
    }

    public function getIsBillable() {

        return isset($this->is_billable);
    }

    public function getResponseMessage() {

        return $this->response_message;
    }

    public function decodeResponse() {

        $entry = isset( $this->body['entry']) ? $this->body['entry'][0] : [];

        \Log::debug("Entry Data: " . json_encode($entry));

        $changes = isset($entry['changes']) ? $entry['changes'] : [];

        \Log::debug("Chages Data: " . json_encode($changes));

        $change_data = isset($changes[0]) ? $changes[0] : [];

        \Log::debug("Chages DATA Data: " . json_encode($change_data));

        $values = isset($change_data['value']) ? $change_data['value'] : [];

        \Log::debug("Values Data: " . json_encode($values));

        $statuses_data = isset($values['statuses']) ? $values['statuses'][0] : [];

        \Log::debug("Statuses Data: " . json_encode($statuses_data));

        $this->display_phone_number = (isset($values['metadata']) && isset($values['metadata']['display_phone_number'])) ? $values['metadata']['display_phone_number'] : '';

        $this->from_phone_number_id = (isset($values['metadata']) && isset($values['metadata']['phone_number_id'])) ? $values['metadata']['phone_number_id'] : '';

        $this->errors = isset($values['errors']) ? $values['errors'] : null;

        $this->timestamp = isset($statuses_data['timestamp']) ? intval($statuses_data['timestamp']) : null;

        $this->message_errors = isset($statuses_data['errors']) ? $statuses_data['errors'] : null;

        $this->message_id = ( isset($statuses_data['id'])) ? $statuses_data['id'] : null;

        $this->state_message = ( isset($statuses_data['status'])) ? $statuses_data['status'] : null;

        $this->statuses_data = $statuses_data;

        $this->response_message = isset( $values['messages'] ) ? new ResponseMessage($values['messages'], $values['contacts']) : null;

    }


}
