<?php
namespace Core;
use Core\Cookie;

class Language {
    private static $_languageClass;
    public function __construct() {
        self::_setLanguageClass();
    }

    public static function set($language) {
        if(self::exists($language)) {
            return Cookie::set("language", $language);
        }else{
            return Cookie::set("language", DEFAULT_LANGUAGE);
        }
    }

    public static function get() {
        if(Cookie::exists("language")) {
            return Cookie::get("language");
        } else {
            self::set(DEFAULT_LANGUAGE);
            return DEFAULT_LANGUAGE;
        }
    }

    public static function exists($language) {
        if(file_exists(DIR_ROOT . DS . 'app' . DS . 'languages' . DS . $language . '.php')) {
            return true;
        }else{
            return false;
        }
    }


    public function getLabel() {
        $l = self::_getLanguageClass();
        return $l->getLabel();
    }
    public function getShortLabel() {
        $l = self::_getLanguageClass();
        return $l->getShortLabel();
    }
    public function getLink() {
        $l = self::_getLanguageClass();
        return $l->getLabel();
    }

    public static function getApp() {
        $l = self::_getLanguageClass();
        return $l->getApp();
    }

    public static function getValidate() {
        $l = self::_getLanguageClass();
        return $l->getValidate();
    }


    private static function _setLanguageClass() {
        $lang = self::get();
        include(DIR_ROOT . DS . 'App' . DS . 'languages' . DS . $lang . '.php');
        self::$_languageClass = new $lang();
    }

    private static function _getLanguageClass() {
        return self::$_languageClass;
    }
 }
