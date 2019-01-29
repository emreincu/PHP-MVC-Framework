<?php

namespace Core;

class Input {
    
    public static function sanitize($input) {
        return htmlentities($input, ENT_QUOTES, 'UTF-8');
    }

    public static function get($data, $input) {
        if(isset($data[$input])) {
            return self::sanitize($data[$input]);
        }
        return null;
    }

 }