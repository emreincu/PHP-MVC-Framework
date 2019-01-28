<?php

namespace Core;

class API {
    public static function JsonEncode($data) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        if($data) {
            http_response_code(200);
            return json_encode($data);
        }else{
            http_response_code(404);
            return null;
        }
    }
}