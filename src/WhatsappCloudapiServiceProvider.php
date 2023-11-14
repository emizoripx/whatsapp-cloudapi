<?php

namespace EmizorIpx\WhatsappCloudapi;

use EmizorIpx\WhatsappCloudapi\Console\Commands\TestFacadeSendMessage;
use EmizorIpx\WhatsappCloudapi\Console\Commands\TestSendMessage;
use EmizorIpx\WhatsappCloudapi\Utils\ManyContactsSendHelper;
use EmizorIpx\WhatsappCloudapi\Utils\WhatsappCloudapiSendHelper;
use Illuminate\Support\ServiceProvider;

class WhatsappCloudapiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__."/Database/Migrations");

        // ROUTES
        $this->loadRoutesFrom(__DIR__."/Routes/api.php");


        // FACADES
        $app = $this->app;

        $app->bind('send_whatsapp_message', function(){
            return new WhatsappCloudapiSendHelper();
        });

        $app->bind('send_whatsapp_text_message', function() {

            return new ManyContactsSendHelper();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // MIGRATIONS

        $this->loadMigrationsFrom(__DIR__."/Database/Migrations");

        // ROUTES
        $this->loadRoutesFrom(__DIR__."/Routes/api.php");


        # CONFIG FILE
        $this->publishes([
            __DIR__."/Config/whatsappcloudapi.php" => config_path('whatsappcloudapi.php')
        ]);

        $this->mergeConfigFrom(__DIR__.'/Config/whatsappcloudapi.php', 'whatsappcloudapi');

        // Load Commands
        if( $this->app->runningInConsole() ) {

            $this->commands([
                TestSendMessage::class,
                TestFacadeSendMessage::class
            ]);
        }
    }
}
