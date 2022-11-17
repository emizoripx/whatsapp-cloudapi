<?php

namespace EmizorIpx\WhatsappCloudapi\Components\Buttons;

class Button {

    protected $type = "button";

    protected $sub_type;

    protected $index;

    protected $parameters;

    protected $builded_button;


    const URL_TYPE_BUTTON = 'url';

    const QUICK_REPLY_TYPE_BUTTON = 'quick_reply';
    

    public function __construct( string $sub_type, int $index, array $parameters = null )
    {
        $this->sub_type = $sub_type;

        $this->index = $index;

        $this->parameters = $parameters;

        $this->makeButton();
        
    }

    public function getSubtype() {

        return $this->sub_type;
    }

    public function getType() {

        return $this->type;
    }

    public function getIndex() {

        return $this->index;
    }

    public function getParameters() {

        return $this->parameters;
    }

    public function getButtonData() {

        return $this->builded_button;
    }


    public function makeButton(){

        $this->builded_button = [
            'type' => $this->getType(),
            'sub_type' => $this->getSubtype(),
            'index' => (string) $this->getIndex()
        ];

        if( isset($this->parameters) ) {
            $this->builded_button = array_merge($this->builded_button, [
                'parameters' => [
                    $this->getParameters()
                ]]);
        }
    }

}