<?php
namespace Core;

use SimpleXMLElement;
use Core\Cookie;

class Language {

    public static function getLanguageFile($language) {
        if(file_exists(DIR_ROOT . DS . "App" . DS . "Languages" . DS . $language . ".xml")) {
            $xml = simplexml_load_file(DIR_ROOT . DS . "App" . DS . "Languages" . DS . $language . ".xml");
            return $xml;
        }else{
            die("Core\Language.php : The language file \"" . $language . "\" does not exists!");
        }
    }



}