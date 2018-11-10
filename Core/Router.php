<?php
namespace Core;
use ReflectionClass;

class Router {

    private $controllerName;
    private $actionName;
    const REGEX_ANNOTATION = '/@(?P<name>\w+)\s+(?P<value>.+)/';
    public static function route($url) {
        // ROUTER HEAD
        $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : array();

        $controller = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_CONTROLLER;
        array_shift($url);
        $action = (isset($url[0]) && $url[0] != '') ? $url[0] : DEFAULT_ACTION;
        array_shift($url);

        /* (Start) CONTROLLER ROUTE ANNOTATION */
        $files = scandir(DIR_CONTROLLERS);
        foreach($files as $file) {
            //
            $class = explode(".", $file);
            if(end($class) == 'php') {
                $class = reset($class);
                //
                $reflector = new ReflectionClass('\\App\\Controllers\\'.$class);
                //
                $commentsArray = null;
                $classComments = $reflector->getDocComment();
                $count = preg_match_all(self::REGEX_ANNOTATION, $classComments, $commentsArray);
                if($count > 0) {
                    /**/
                    $routeComment = array_search("Route", $commentsArray["name"]);
                    $routeValue = $commentsArray["value"][$routeComment];
                    $routeValue = str_replace(' ', '', $routeValue);
                    $routeValues = explode(",", $routeValue);

                    foreach($routeValues as $routeVal) {
                        if($controller == $routeVal) {
                            
                            $controller = $class;
                            break;
                        }
                    }
                }

                $methods = get_class_methods('\\App\\Controllers\\'.$class);
                foreach($methods as $method) {
                    $methodComments = $reflector->getMethod($method)->getDocComment();
                    $commentsArray = null;
                    $count = preg_match_all(self::REGEX_ANNOTATION, $methodComments, $commentsArray);
                    if($count > 0) {
                        /**/
                        $routeComment = array_search("Route", $commentsArray["name"]);
                        $routeValue = $commentsArray["value"][$routeComment];
                        $routeValue = str_replace(' ', '', $routeValue);
                        $routeValues = explode(",", $routeValue);

                        foreach($routeValues as $routeVal) {
                            if($action == $routeVal) {
                                $action = $method;
                                break;
                            }
                        }

                    }
                }
            }
        }
        /* (Finish) CONTROLLER ROUTE ANNOTATION */

        $controller = ucwords($controller);
        $controller = '\\app\\controllers\\'.$controller;

        $parameters = $url;
        
        $dispatch = new $controller($controller, $action);

        if(method_exists($controller, $action)) {
            call_user_func_array([$dispatch, $action], $parameters);
        } else {
            die("That method does not exists in the controller! \"" . $action ."\"");
        }
        // ROUTER END
    } 
    
}