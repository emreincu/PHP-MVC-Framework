<?php

namespace App\Controllers;

use Core\Cookie;

class Language {

    public function set($language) {
        if(!Cookie::exists($language)) {
            if(file_exists(DIR_ROOT . DS . "App" . DS . "Languages" . DS . $language . ".xml")) {
                Cookie::set("language", $language);
                turn();
            }else{
                die("App\Controllers\Language.php : The language file \"" . $language . "\" does not exists!");
            }
        }
    }

    public function get() {
        if(Cookie::exists("language"))
            return Cookie::get("language");
    }
    
    public function kill() {
        Cookie::delete("language");
        turn();
    }
}