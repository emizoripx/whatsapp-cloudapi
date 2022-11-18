<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => "\EmizorIpx\WhatsappCloudapi\Http\Controllers\Api", 'prefix' => 'cloud-whatsapp'], function () {

    Route::get('callback', 'CloudWhatsappMessageController@verify');
    Route::post('callback', 'CloudWhatsappMessageController@callback');



});