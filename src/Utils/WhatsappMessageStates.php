<?php

namespace EmizorIpx\WhatsappCloudapi\Utils;

use EmizorIpx\WhatsappCloudapi\Models\WhatsappMessage;
use Carbon\Carbon;

class WhatsappMessageStates {


    public static function getDescriptionState( $state ){

        switch ($state) {
            case WhatsappMessage::DISPATCHED_STATE:
                return "El mensaje fue despachado a enviar.";
                break;
            case WhatsappMessage::SENT_STATE:
                return "El mensaje fue enviado correctamente al usuario final.";
                break;
            case WhatsappMessage::DELIVERED_STATE:
                return "El mensaje fue entregado con éxito al usuario final.";
                break;
            case WhatsappMessage::READ_STATE:
                return "El mensaje ha sido leído por el usuario final.";
                break;
            case WhatsappMessage::DELETED_STATE:
                return "El mensaje ha sido borrado.";
                break;
            case WhatsappMessage::FAILED_STATE:
                return "No se ha podido entregar el mensaje.";
                break;
            
            default:
                return "Estado no esperado.";
                break;
        }

    }


    public static function setStateDate($state, $date = null){

        $array_data = [];

        switch ($state) {
            case WhatsappMessage::DISPATCHED_STATE:
                return ['dispatched_date' => Carbon::parse($date)->toDateTimeString()];
                break;
            case WhatsappMessage::SENT_STATE:
                return ['send_date' => Carbon::parse($date)->toDateTimeString()];
                break;
            case WhatsappMessage::DELIVERED_STATE:
                return ['delivered_date' => Carbon::parse($date)->toDateTimeString()];
                break;
            case WhatsappMessage::READ_STATE:
                return ['read_date' => Carbon::parse($date)->toDateTimeString()];
                break;
            
            default:
                return $array_data;
                break;
        }

    }

}