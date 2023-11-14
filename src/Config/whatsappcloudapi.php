<?php

return [

    'whatsapp_cloud_api_host' => env('WHATSAPP_CLOUD_API_HOST', 'https://graph.facebook.com'),

    'language_template' => 'ES',

    'cloud_api_version' => 'v15.0',

    'forward_notification_enabled' => env('FORWARD_CALLBACK_NOTIFICACTIONS_ENABLED', false),

    'url_to_forward_notification' => env('URL_TO_FORWARD_NOTIFICACTIONS', null),

    'manycontacts_api_host' => env('MANYCONTACTS_API_HOST', 'https://api.manycontacts.com'),

    'manycontacts_api_key' => env('MANYCONTACTS_API_TOKEN')
];
