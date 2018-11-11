<?php
namespace Core;
use ReflectionClass;

class Router {

    private $controllerName;
    private $actionName;
    const REGEX_ANNOTATION = '/@(?P<name>\w+)\s+(?P<value>.+)/';
    public static function route($url) {

        $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : array();

        $controller = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_CONTROLLER;
        array_shift($url);
        $action = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_ACTION;
        array_shift($url);

        $controller = ucwords($controller);
        $controller = '\\App\\Controllers\\'.$controller;

        $parameters = $url;
        
        $dispatch = new $controller($controller, $action);

        if(method_exists($controller, $action)) {
            call_user_func_array([$dispatch, $action], $parameters);
        } else {
            die("That method does not exists in the controller! \"" . $action ."\"");
        }
    } 
    
}