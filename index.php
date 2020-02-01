<?php

use Core\Router;

define('DS', DIRECTORY_SEPARATOR);
define('DIR_ROOT', dirname(__FILE__));

//define('URL_ROOT', DS . basename(__DIR__)); //For Apache
define('URL_ROOT', ""); //For Nginx

require_once(DIR_ROOT . DS . 'Config' . DS . 'Config.php');
require_once(DIR_ROOT . DS . 'App' . DS . 'Lib' . DS . 'Helpers' . DS . 'Functions.php');

spl_autoload_register(function($className) {
    $file = str_replace('\\', DS, $className);
    if(DEBUG_CLASSES) {
        _vd($file);
    }
    $fileFullPath = DIR_ROOT . DS . $file . '.php';
    if(file_exists($fileFullPath)) {
        include_once $fileFullPath;
    }
});

session_start();

//$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : array(); //For Apache
$url = isset($_SERVER['REQUEST_URI']) ? explode('/', ltrim($_SERVER['REQUEST_URI'], '/')) : array(); //For Nginx
Router::route($url);

?>