<?php

namespace Core;

use Core\Language;
use Core\API;

class Router {
    
    private $className;
    private $actionName;
   
    public static function route($url) {

        $class = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_CONTROLLER;
        $class = ucwords($class);

        if($class === "Api") {
            array_shift($url);
            $action = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_ACTION;
            $action = ucwords($action);
            $class = '\\App\\APIs\\'.$action;
            array_shift($url);
            $action = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_ACTION;
            array_shift($url);
            $parameters = $url;

            if(class_exists($class)){
                $dispatch = new $class($class, $action);
                if(method_exists($class, $action)) {
                    Language::initLanguage();
                    call_user_func_array([$dispatch, $action], $parameters);
                } else {
                    echo API::JsonEncode(null);
                }
            }else{
                echo API::JsonEncode(null);
            }
        }else{
            $class = '\\App\\Controllers\\'.$class;
            
            array_shift($url);
            $action = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_ACTION;
            
            array_shift($url);
            $parameters = $url;

            if(class_exists($class)){
                $dispatch = new $class($class, $action);
                if(method_exists($class, $action)) {
                    Language::initLanguage();
                    call_user_func_array([$dispatch, $action], $parameters);
                } else {
                    die("That method does not exists in the controller!");
                }
            }else{
                die("That class does not exists in the controllers!");
            }
        }
        
        
    }

    public function setClassName($className) {
        $this->className = $className;
    }
    
    public function setActionName($actionName) {
        $this->actionName = $actionName;
    }

    public function getClassName() {
        return $this->className;
    }
    
    public function getActionName() {
        return $this->actionName;
    }
}