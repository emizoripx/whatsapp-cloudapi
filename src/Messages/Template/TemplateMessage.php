<?php

namespace EmizorIpx\WhatsappCloudapi\Messages\Template;

use EmizorIpx\WhatsappCloudapi\Messages\Message;

class TemplateMessage extends Message {

    protected $type = 'template';

    protected $template_name;

    protected $language;

    protected $components;

    public function __construct( string $number_phone, string $template_name, ?Component $components = null)
    {
        $this->template_name = $template_name;

        $this->components = $components;

        parent::__construct($number_phone);
        
    }

    public function getTemplateName() {
        return $this->template_name;
    }

    public function getHeader() {
        return $this->components ? $this->components->getHeader() : [];
    }

    public function getBody() {
        return $this->components ? $this->components->getBody() : [];
    }

    public function getButtons() {
        return $this->components ? $this->components->getButtons() : [];
    }

}