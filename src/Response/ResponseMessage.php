<?php

namespace EmizorIpx\WhatsappCloudapi\Response;

/**
 * Class ResponseMessage
 *
 * Represents a response message from WhatsApp Cloud API.
 */
class ResponseMessage {

    protected $message;

    protected $contacts;

    protected $profile;

    protected $from;

    protected $id;

    protected $timestamp;

    protected $text;

    protected $type;

    protected $wa_id;

    public function __construct( array $messages, array $contacts) {

        $this->message = $messages[0];

        $this->contacts = $contacts[0];

        $this->decodeMessage();

    }

    /**
     * Get Profile of Author Message
     *
     * @return array|null An associative array representing the profile information.
     *                    The array structure is ['profile' => ['name' => 'ProfileName']].
     */
    public function getProfile() {

        return $this->profile;
    }

    public function getWaId() {

        return $this->wa_id;
    }

    /**
     * Get from number send Message
     *
     * @return string|null
     */
    public function getFrom(){

        return $this->from;
    }

    /**
     * Get WamId - Id Message
     *
     * @return string|null
     */
    public function getId() {

        return $this->id;
    }

    /**
     * Get Timestamp mnessage sent
     *
     * @return string|null
     */
    public function getTimestamp() {

        return $this->timestamp;
    }

    /**
     * Get text body of message
     *
     * @return array|null ['body' => 'Text Body']
     */
    public function getText() {

        return $this->text;
    }

    /**
     * Get Type Message
     *
     * @return string|null
     */
    public function getType() {

        return $this->type;
    }

    public function decodeMessage() {

        $this->profile = isset( $this->contacts['profile'] ) ? $this->contacts['profile'] : [];

        $this->wa_id = isset($this->contacts['wa_id']) ? $this->contacts['wa_id'] : null;

        \Log::debug('Profile: ' . json_encode( $this->profile ));

        $this->from = isset( $this->message['from'] ) ? $this->message['from'] : null;

        $this->id = isset( $this->message['id'] ) ? $this->message['id'] : null;

        $this->timestamp = isset( $this->message['timestamp'] ) ? $this->message['timestamp'] : null;

        $this->text = isset( $this->message['text'] ) ? $this->message['text'] : null;

        $this->type = isset( $this->message['type'] ) ? $this->message['type'] : null;

    }
}
