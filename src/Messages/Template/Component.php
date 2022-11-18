<?php

namespace EmizorIpx\WhatsappCloudapi\Messages\Template;

class Component {

    /**
     * Parameters of a header template.
     * @var array
     */
    protected $header;

    /**
     * Parameters of a body template.
     * @var array
     */
    protected $body;

    /**
     * Buttons to attach to a template.
     * @var array
     */
    protected $buttons;

    /**
     * @param array $header
     * @param array $body
     * @param array $buttons
     */
    public function __construct( array $header = [], array $body = [], array $buttons = [] ) 
    {

        $this->header = $header;
        $this->body = $body;
        $this->buttons = $buttons;
        
    }

    public function getHeader() {
        return $this->header;
    }

    public function getBody() {
        return $this->body;
    }

    public function getButtons() {
        return $this->buttons;
    }

}