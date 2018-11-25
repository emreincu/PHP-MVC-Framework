<?php
namespace Core;
use Core\Application;

class Controller extends Application {
    private $_controller, $_action;
    protected $view;

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }
}
