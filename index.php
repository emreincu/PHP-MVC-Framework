<?php
use Core\Router;

define('DS', DIRECTORY_SEPARATOR);
define('DIR_ROOT', dirname(__FILE__));
define('URL_ROOT', DS . basename(__DIR__));

require_once(DIR_ROOT . DS . 'Config' . DS . 'Config.php');
require_once(DIR_ROOT . DS . 'App' . DS . 'Lib' . DS . 'Helpers' . DS . 'Functions.php');


spl_autoload_register(function($className) {
    $file = str_replace('\\', DS, $className);
    if(file_exists(DIR_ROOT . DS . $file . '.php')) {
        include_once DIR_ROOT . DS . $file . '.php';
    }
});

session_start();

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : array();

Router::route($url);

?>