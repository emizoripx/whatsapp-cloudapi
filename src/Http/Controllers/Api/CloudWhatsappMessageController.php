<?php

namespace EmizorIpx\WhatsappCloudapi\Http\Controllers\Api;

use EmizorIpx\WhatsappCloudapi\Events\WhatsappResponseMessageReceived;
use EmizorIpx\WhatsappCloudapi\Jobs\ForwardCallbackNotification;
use EmizorIpx\WhatsappCloudapi\Models\WhatsappMessage;
use EmizorIpx\WhatsappCloudapi\Response\CallbackManyContactsResponse;
use EmizorIpx\WhatsappCloudapi\Response\CallbackResponse;
use EmizorIpx\WhatsappCloudapi\Utils\WhatsappMessageStates;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CloudWhatsappMessageController extends Controller
{

    public function verify( Request $request) {

        $data = $request->all();

        \Log::debug("Data Verify: " . json_encode($data));

        $challenge = $data['hub_challenge'];

        return $challenge;

    }


    public function callback( Request $request) {

        \Log::debug("WHATSAPP CLOUD API Callback INIT >>>>>>>>>>>>>>>>>>>>>> ");

        $data = $request->all();

        \Log::debug(" WHATSAPP CLOUD API Callback >>>>>>>>>>>>>>>>>>>>>> Callback Data: " . json_encode($data));

        $callback_reponse = new CallbackResponse($data);

        if( ! is_null($callback_reponse->getResponseMessage()) ) {

            // TODO: Send Event
            event( new WhatsappResponseMessageReceived( $callback_reponse ) );

            return;
        }


        if( empty( $callback_reponse->getStatusesData() ) ) {

            \Log::debug("WHATSAPP CLOUD API Callback >>>>>>>>>>>>>>>>>>>>>> Nose encontró Notificación de Estado");

            return;

        }

        if( empty( $callback_reponse->getMessageId()) || is_null($callback_reponse->getMessageId()) ) {

            \Log::debug("WHATSAPP CLOUD API Callback >>>>>>>>>>>>>>>>>>>>>> Message ID no Recibido");

            return;

        }

        $message = WhatsappMessage::where('message_id', $callback_reponse->getMessageId())->first();

        if( ! $message ) {

            \Log::debug("WHATSAPP CLOUD API Callback >>>>>>>>>>>>>>>>>>>>>> Mensaje no encontrado");

            ForwardCallbackNotification::dispatch($data)->delay(now()->addSeconds(2))->onQueue('default');

            return;

        }

        $data_update = [
            'last_callback_reponse' => json_encode($callback_reponse->getBody())
        ];

        if( $callback_reponse->getStateMessage() ){

            $data_update = array_merge($data_update, [
                'status' => $callback_reponse->getStateMessage() == WhatsappMessage::FAILED_STATE ? $callback_reponse->getStateMessage() : 'success',
                'state' => $callback_reponse->getStateMessage(),
                'status_description' => WhatsappMessageStates::getDescriptionState($callback_reponse->getStateMessage())
            ]);
        }

        if( $callback_reponse->getMessageErrors() ){

            $data_update = array_merge($data_update, [
                'error_details' => json_encode($callback_reponse->getMessageErrors())
            ]);
        }

        if( $callback_reponse->getErrors() ){

            $data_update = array_merge($data_update, [
                'errors' => json_encode($callback_reponse->getErrors())
            ]);
        }

        if( $callback_reponse->getTimestamp() ){

            $data_update = array_merge($data_update, WhatsappMessageStates::setStateDate($callback_reponse->getStateMessage(), $callback_reponse->getTimestamp()) );
        }

        $message->update($data_update);


        return;

    }

    public function manyContactsCallback( Request $request  ) {

        \Log::debug("WHATSAPP CLOUD API Callback INIT >>>>>>>>>>>>>>>>>>>>>> " . $request->getHost());

        $data = $request->all();

        \Log::debug(" WHATSAPP CLOUD API Callback >>>>>>>>>>>>>>>>>>>>>> Callback Data: " . json_encode($data));

        $callback_reponse = new CallbackManyContactsResponse($data);

        if( ! is_null($callback_reponse->getResponseMessage()) ) {

            // TODO: Send Event
            event( new WhatsappResponseMessageReceived( $callback_reponse ) );

            return;
        }
    }

}
