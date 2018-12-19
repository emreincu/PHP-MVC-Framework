<?php
namespace Core;

use SimpleXMLElement;
use Core\Cookie;

class Language {

    public static function getLanguageFile($language) {
        if(file_exists(DIR_ROOT . DS . "App" . DS . "Languages" . DS . $language . ".xml")) {
            $xml_str = file_get_contents(DIR_ROOT . DS . "App" . DS . "Languages" . DS . $language . ".xml");
            $xml = new SimpleXMLElement($xml_str);
            $items = $xml->xpath('*/convert');
            var_dump($items);
        }else{
            die("Core\Language.php : The language file \"" . $language . "\" does not exists!");
        }
    }
}