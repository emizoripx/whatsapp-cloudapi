<?php

namespace EmizorIpx\WhatsappCloudapi\Utils;

use EmizorIpx\WhatsappCloudapi\Exceptions\WhatsappCloudapiException;
use EmizorIpx\WhatsappCloudapi\Messages\Template\Component;
use EmizorIpx\WhatsappCloudapi\Models\WhatsappMessage;
use EmizorIpx\WhatsappCloudapi\Services\Whatsapp\Settings\WhatsappCloudApiSettings;
use EmizorIpx\WhatsappCloudapi\Services\Whatsapp\WhatsappService;
use Carbon\Carbon;
use EmizorIpx\WhatsappCloudapi\Exceptions\WhatsappCloudapiServiceException;
use Exception;

class WhatsappCloudapiSendHelper {


    public function sendMessageWithTemplate( WhatsappCloudApiSettings $settings, string $phone_number, string $template_name, Component $components ){

        try{

            $message_key = strtoupper(str_replace( '.', '', uniqid('', true) )) ;

            if( is_null($phone_number) || empty($phone_number) ) {

                throw new WhatsappCloudapiException('Número de Teléfono requerido');
            }

            if( is_null($template_name) || empty($template_name) ) {

                throw new WhatsappCloudapiException('Plantilla requerida');
            }

            $whatsapp_message = WhatsappMessage::create([
                'message_key' => $message_key,
                'number_phone' => $phone_number,
            ]);

            $cloud_whatsapp_service = new WhatsappService( $settings->getFromPhoneNumberId(), $settings->getAccessToken() );

            $response = $cloud_whatsapp_service->sendTemplateWhatsapp($phone_number, $template_name,  $components);

            $response_decoded = $response->getDecodedBody();
            \Log::debug("Reponse Cloud Whatsapp Send: " . json_encode( $response->getDecodedBody() ));

            $whatsapp_message->update([
                'status' => WhatsappMessage::SUCCESS_STATUS,
                'state' => WhatsappMessage::DISPATCHED_STATE,
                'message_id' => $response_decoded['messages'][0]['id'],
                'dispatched_date' => Carbon::now()->toDateTimeString(),
                'message' => json_encode($cloud_whatsapp_service->getPreparedData())
            ]);

            return ['message_key' => $message_key, 'message' => WhatsappMessageStates::getDescriptionState(WhatsappMessage::DISPATCHED_STATE)];

        } catch ( WhatsappCloudapiException | Exception $ex ) {

            \Log::debug("Exception in Helpers " . $ex->getMessage() . "File: ". $ex->getFile() . " Line: " . $ex->getLine());

            if(isset($whatsapp_message)){
                $whatsapp_message->update([
                    'errors' => $ex->getMessage(),
                    'billable' => 0
                ] );
            }
            $msg = $ex->getMessage();
            if( $ex instanceof WhatsappCloudapiException ){
                $msg = json_decode ($msg);
                $msg->message_key = $message_key;
                $msg = json_encode($msg);
                \Log::debug("Error return " . $msg);
            }

            throw new WhatsappCloudapiServiceException ($msg);

        }


    }

}