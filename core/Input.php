<?php
namespace core;

if(!defined('DIRECT_ACCESS')) {
    die("Erişim izniniz bulunmamaktadır!");
}

class Input {
    public static function sanitize($input) {
        return htmlentities($input, ENT_QUOTES, 'UTF-8');
    }

    public static function get($input) {
        if(isset($_POST[$input])) {
            return self::sanitize($_POST[$input]);
        }elseif(isset($_GET[$input])) {
            return self::sanitize($_GET[$input]);
        }
    }
 }
