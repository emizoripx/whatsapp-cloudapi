<?php 

namespace EmizorIpx\WhatsappCloudapi\Components\Headers;


class Headers {

    public static function createImageHeaders( $link ) {

        $array_parameters = [
            "link" => $link
        ];

        $header_image = new Header(Header::IMAGE_HEADER_TYPE, $array_parameters );

        return $header_image->getHeaderData();

    }

    public static function createDocumentHeader( $link, $filename ){

        $array_data = [
            "link" => $link,
            "filename" => $filename
        ];

        $header_document = new Header(Header::DOCUMENT_HEADER_TYPE, $array_data);

        return $header_document->getHeaderData();
    }

    public static function createTextHeader( $text ){

        $text_header = new Header(Header::TEXT_HEADER_TYPE, $text);

        return $text_header->getHeaderData();
    }

}