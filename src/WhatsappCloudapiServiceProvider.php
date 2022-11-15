<?php

namespace EmizorIpx\WhatsappCloudapi;

use EmizorIpx\WhatsappCloudapi\Console\Commands\TestSendMessage;
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


        # CONFIG FILE
        $this->publishes([
            __DIR__."/Config/whatsappcloudapi.php" => config_path('whatsappcloudapi.php')
        ]);

        $this->mergeConfigFrom(__DIR__.'/Config/whatsappcloudapi.php', 'whatsappcloudapi');

        // Load Commands
        if( $this->app->runningInConsole() ) {

            $this->commands([
                TestSendMessage::class
            ]);
        }
    }
}
