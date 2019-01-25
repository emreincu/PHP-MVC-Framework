<?php

namespace Core;

use Core\Language;

class View {

    private $_buffer, $_addedBuffers = [];
    private static $_layout = DEFAULT_LAYOUT;

    public function render($viewName, $yield = []) {
        $viewArray = explode("/", $viewName);
        $viewFile = array_pop($viewArray);
        $viewFolder = $viewArray;
        $viewFolder = implode(DS, $viewFolder);
        if(file_exists(DIR_ROOT .   DS . "App" . DS . "Views" . DS . $viewFolder . DS . $viewFile . ".php")) {

            if(!empty($yield)) {
                extract($yield);
            }

            $language = new Language();
            $language = $language->getLanguage(Cookie::get("language"));


            if(file_exists(DIR_ROOT . DS . "App" . DS . "Views" . DS . "Layouts" . DS . self::$_layout . ".php")) {
                include(DIR_ROOT . DS . "App" . DS . "Views" . DS . "Layouts" . DS . self::$_layout . ".php");
            }

            include(DIR_ROOT . DS . "App" . DS . "Views" . DS . $viewFolder . DS . $viewFile . '.php');
            
        }else{
            die("The View File \"" . $viewName . "\" is not found!"); 
        }
    }

    public function content($type) {
        if(array_key_exists($type, $this->_addedTypes)) {
            return $this->_addedTypes[$type];
        }else{
            die("<p>The layout type \"" . $type . "\" does not exists!</p>");
        }
    }

    public function start($type) {
        $this->_buffer = $type;
        ob_start();
    }

    public function end($type) {
        $this->_addedTypes[$type] = ob_get_clean();
    }

    public static function setLayout($layout) {
        self::$_layout = $layout;
    }
}