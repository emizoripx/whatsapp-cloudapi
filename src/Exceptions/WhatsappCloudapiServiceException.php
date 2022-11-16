<?php

namespace EmizorIpx\WhatsappCloudapi\Exceptions;

use Exception;

class WhatsappCloudapiServiceException extends Exception
{
    public function __construct($msg)
    {
        $finalMessage = 'Errors';

        if ($msg != null) {
            $finalMessage = $msg;
        }

        parent::__construct($finalMessage);
    }
}
