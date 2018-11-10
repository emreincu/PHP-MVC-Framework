<?php
namespace Core;

class Loader {
    public function model($modelName, $tables = null) {
        if(file_exists(DIR_ROOT . DS . 'app' . DS . 'models' . DS . $modelName . '.php')) {
            require_once(DIR_ROOT . DS . 'app' . DS . 'models' . DS . $modelName . '.php');
            $modelName .= "Model";  
            return new $modelName($tables);
        }else {
            die("The Model \"" . $modelName . "\" does not exists!");
        }
    }

    public function view() {
        return new View();
    }
}

 ?>
