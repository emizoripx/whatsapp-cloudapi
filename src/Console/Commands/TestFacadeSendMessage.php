<?php

namespace EmizorIpx\WhatsappCloudapi\Console\Commands;

use EmizorIpx\WhatsappCloudapi\Exceptions\WhatsappCloudapiServiceException;
use EmizorIpx\WhatsappCloudapi\Facades\WhatsappCloudapiMessage;
use EmizorIpx\WhatsappCloudapi\Messages\Template\Component;
use EmizorIpx\WhatsappCloudapi\Services\Whatsapp\Settings\WhatsappCloudApiSettings;
use EmizorIpx\WhatsappCloudapi\Services\Whatsapp\WhatsappService;
use Illuminate\Console\Command;

class TestFacadeSendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloud:send-facade-message {number_phone}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test to send whatsapp message with cloud api';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $phone_number = $this->argument('number_phone');


        $component_buttons = [
            [
                "type" => "button",
                "sub_type" => "url",
                "index" => "0",
                "parameters" => [
                    [
                        "type" => "text",
                        "text"=> "3/QR-Pago-1666654672.jpg"
                    ]
                ]
            ]
        ];

        $component_headers = [
                [
                  "type" => "image",
                  "image" => [
                    "link" => "https://devqr.s3.amazonaws.com/Qr-Images/3/QR-Pago-1666654672.jpg"
                  ]
                ]
        ];

        $components = new Component($component_headers, [], $component_buttons);

        $cloud_api_settings = new WhatsappCloudApiSettings('100217716213600', 'EAAQgOnTiZClYBADZCombKxUdeJ7O91r0r1S8ox4lMkkboQpfZC5VD9mxS3aTKnkZAw0lXq6amrtQSOWedQ9wWqOp7PZBPVvLd7dnG5nZAQfRTi30P4CZBe0AYbt5P0Shod3KbZA8nTdCKEhIZCAZB6o5i4yJMU6uwN0ldDbczsgYz1iDBPxHOsSPTGbvwjtv1rnkoQYhaax134ogZDZD');

        try {

            $response = WhatsappCloudapiMessage::sendMessageWithTemplate($cloud_api_settings, '591'.$phone_number, 'emizor_digitaltv_notifqr_dev', $components);
    
            \Log::debug("Reponse de envio " . json_encode($response));
        } catch(WhatsappCloudapiServiceException $wex) {

            \Log::debug("Error al enviar mensaje Test: " . $wex->getMessage());

        }

        
    }
}
