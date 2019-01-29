<?php

namespace Core;

use Core\Language;

class Router {
    
    private $className;
    private $actionName;
   
    public static function route($url) {

        $class = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_CONTROLLER;
        $class = ucwords($class);

        if($class === "Api") {
            Response::setHeader("Access-Control-Allow-Origin" , "*");
            Response::setHeader("Content-Type" , "application/json; charset=UTF-8");
            Response::setHeader("Access-Control-Allow-Credentials" , "true");
            Response::setHeader("Content-Type" , "application/json");

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
                    Language::init();
                    call_user_func_array([$dispatch, $action], $parameters);
                } else {
                    Response::setStatus(404);
                }
            }else{
                Response::setStatus(404);
            }
        }else{
            if($class === "Language") {
                $class = '\\Core\\Language';
            }else{
                $class = '\\App\\Controllers\\'.$class;
            }
            
            array_shift($url);
            $action = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_ACTION;
            
            array_shift($url);
            $parameters = $url;

            if(class_exists($class)){
                $dispatch = new $class($class, $action);
                if(method_exists($class, $action)) {
                    Language::init();
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