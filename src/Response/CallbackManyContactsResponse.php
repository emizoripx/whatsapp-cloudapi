<?php

namespace EmizorIpx\WhatsappCloudapi\Response;

use EmizorIpx\WhatsappCloudapi\Response\Abstracts\AbstractCallbackResponse;


class CallbackManyContactsResponse extends AbstractCallbackResponse
{
    /**
     * @param array<int,mixed> $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->decodeResponse();
    }

    public function decodeResponse(): void
    {

        $statuses_data = isset($this->body['statuses']) ? $this->body['statuses'][0] : [];

        \Log::debug("Statuses Data: " . json_encode($statuses_data));

        $this->errors = isset($this->body['errors']) ? $this->body['errors'] : null;

        $this->timestamp = isset($statuses_data['timestamp']) ? intval($statuses_data['timestamp']) : null;

        $this->message_errors = isset($statuses_data['errors']) ? $statuses_data['errors'] : null;

        $this->message_id = (isset($statuses_data['id'])) ? $statuses_data['id'] : null;

        $this->state_message = (isset($statuses_data['status'])) ? $statuses_data['status'] : null;

        $this->statuses_data = $statuses_data;

        $this->response_message = isset($this->body['messages']) ? new ResponseMessage($this->body['messages'], $this->body['contacts']) : null;
    }
}
