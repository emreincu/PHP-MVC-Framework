<?php
namespace app\controllers;
use core\Controller;
use core\Language as LanguageCore;
use core\Cookie;

/**
* @Route dil
*/
class Language extends Controller {
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    /**
    *@Route ana
    */
    public function index() {
        go(URL_ROOT);
    }

    /**
    * @Route degistir
    */
    public function change($language = DEFAULT_LANGUAGE) {
        if(LanguageCore::set($language)) {
            turn();
        }
    }

    public function clear() {
        Cookie::delete("language");
        go(URL_ROOT);
    }
}
