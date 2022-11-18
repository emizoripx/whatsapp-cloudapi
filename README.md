# WHATSAPP CLOUD API PACKAGE v1.0.0

## Package for sending Whatsapp messages with the Whatsapp Cloud Api Service.

### Supports
- Send messages with a predefined template.
- Send documents and multimedia.
- Send buttons or links.
- Currently supports sending to a single cell phone number.


## Configure
Before use, you must configure the following parameters

- In the `.env` file of the project copy and set the following environment variables

```
    WHATSAPP_CLOUD_API_HOST=
```

## Usage

- To send a message just call the Facade  `EmizorIpx\WhatsappMessages\Facades\WhatsappMessage` to method `sendWhithTemplate` and specify the required parameters

```php
    
    use EmizorIpx\WhatsappCloudapi\Facades\WhatsappCloudapiMessage;
    use EmizorIpx\WhatsappCloudapi\Messages\Template\Component;
    use EmizorIpx\WhatsappCloudapi\Services\Whatsapp\Settings\WhatsappCloudApiSettings;
    ...

    $cloud_settings = new WhatsappCloudApiSettings( $from_phone_number_id, $access_token );
    $components = new Component($header_components, $body_components, $buttons_components);

    WhatsappMessage::sendWhithTemplate( WhatsappCloudapiMessage::sendMessageWithTemplate($cloud_settings, $phone_number, $template_name, $components); );

```

- Parameters
    - `from_phone_number_id` Phone number identifier.
    - `access_token` whatsapp cloud api services access token.