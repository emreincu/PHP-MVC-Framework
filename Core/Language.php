<?php

namespace Core;

use Core\Cookie;

class Language {

    public static function getLanguage($language) {
        if($language == null) {
            $language = DEFAULT_LANGUAGE;
        }
        if(file_exists(DIR_ROOT . DS . "App" . DS . "Languages" . DS . $language . ".xml")) {
            $xml = simplexml_load_file(DIR_ROOT . DS . "App" . DS . "Languages" . DS . $language . ".xml");
            return $xml->site;
        }else{
            die("Core\Language.php (Site) : The language file \"" . $language . "\" does not exists!");
        }
    }

    public static function getValidate($language) {
        if($language == null) {
            $language = DEFAULT_LANGUAGE;
        }
        if(file_exists(DIR_ROOT . DS . "App" . DS . "Languages" . DS . $language . ".xml")) {
            $xml = simplexml_load_file(DIR_ROOT . DS . "App" . DS . "Languages" . DS . $language . ".xml");
            return $xml->validation;
        }else{
            die("Core\Language.php (Validate) : The language file \"" . $language . "\" does not exists!");
        }
    }

    public static function initLanguage() {
        if(!Cookie::exists("language") || Cookie::get("language") == null) {
            if(file_exists(DIR_ROOT . DS . "App" . DS . "Languages" . DS . DEFAULT_LANGUAGE . ".xml")) {
                Cookie::set("language", DEFAULT_LANGUAGE);
            }else{
                die("Core\Application.php : The language file \"" . DEFAULT_LANGUAGE . "\" does not exists!");
            }
        }
    }
}