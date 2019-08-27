<?php

namespace Core;

use Core\Language;

/**
 * Class Router
 */
class Router {
    
    private $className;
    private $actionName;

   /**
    * Function route
    * @param array $url is the array of request
    * @return void
    */
    public static function route(array $url) {

        /*
         * feature-notice: i will add here the annotation system like spring mvc.
         */

        $class = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_CONTROLLER;
        $class = ucwords($class);
        $namespace = "";

        $default_class = DEFAULT_CONTROLLER;
        $default_action = DEFAULT_ACTION;

        if($class === "Api") {
            array_shift($url);
            $namespace .= '\\App\\APIs\\';
            $default_class = DEFAULT_API;
        }else if($class === "Language"){
            $namespace .= '\\Core\\';
            $default_class = "Language";
        }else{
            $namespace .= '\\App\\Controllers\\';
            $default_class = DEFAULT_CONTROLLER;
        }

        $class = (isset($url[0]) && $url[0] != '') ? $url[0] : $default_class;
        $class = $namespace . ucwords($class);

        array_shift($url);
        $action = (isset($url[0]) && $url[0] != '') ? $url[0] : $default_action;
        
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