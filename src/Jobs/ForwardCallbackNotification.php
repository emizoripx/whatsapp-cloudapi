<?php

namespace EmizorIpx\WhatsappCloudapi\Jobs;

use EmizorIpx\WhatsappCloudapi\Services\ForwardCallback\ForwardCallbackNotificationService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ForwardCallbackNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data_notification;

    public $tries = 3;

    public $maxExceptions = 3;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $data_notification )
    {
        $this->data_notification = $data_notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Log::debug("FORWARD NOTIFICATIONS JOB >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> INIT");
        $forward_notification = config('whatsappcloudapi.forward_notification_enabled');

        if( ! $forward_notification ){
            \Log::debug("FORWARD NOTIFICATIONS JOB >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  No se tiene configurado el reenvio de notificaciones");

            return;
        }

        $url_to_forward_notification = config('whatsappcloudapi.url_to_forward_notification');

        if( is_null( $url_to_forward_notification ) ) {

            \Log::debug("FORWARD NOTIFICATIONS JOB >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  No se tiene configurado una URL para reenviar la notificacion");

            return;
        }
        
        try {

            $forward_service = new ForwardCallbackNotificationService($url_to_forward_notification, $this->data_notification);

            $forward_service->forwardCallback();

        } catch(Exception $ex){

            \Log::debug("Ocurrio un error al reenviar la notificación a: " . (isset($url_to_forward_notification) ? $url_to_forward_notification : ''));

            $this->release(20);

        }

    }
}
