<?php

namespace EmizorIpx\WhatsappCloudapi\Console\Commands;

use EmizorIpx\WhatsappCloudapi\Exceptions\WhatsappCloudapiException;
use EmizorIpx\WhatsappCloudapi\Messages\Template\Component;
use EmizorIpx\WhatsappCloudapi\Services\Whatsapp\WhatsappService;
use Illuminate\Console\Command;

class TestSendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloud:send-message {number_phone}';

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

        $cloud_whatsapp_service = new WhatsappService( '100217716213600', 'EAAQgOnTiZClYBAMUi8GV35ZBcYSp4QgrRscfOzoZAaEHQGZBKCzSbtfPsuvLZCVhC3FigoxUkiy5Az8FcBfT9q3ZAO9Jg5sOmnxiNhMACOq2sAteUxrDpHLLdZCU9osHklk8GhSYg5k9fOXTsjsQrKOT85CldQAwKPMOik61cym05sKdaGNZADoI9hvcAY6cB26kZBGMidR6ZCdwZDZD' );

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

        try {

            $response = $cloud_whatsapp_service->sendTemplateWhatsapp('591' . $phone_number, 'emizor_digitaltv_notifqr_dev', $components);
    
            \Log::debug("Reponse de envio " . json_encode($response->getDecodedBody()));
        } catch(WhatsappCloudapiException $wex) {

            \Log::debug("Error al enviar mensaje Test: " . $wex->getMessage());

        }

        
    }
}
