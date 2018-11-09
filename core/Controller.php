<?php
namespace core;
use core\Application;
use core\View;
use core\Language;

if(!defined('DIRECT_ACCESS')) {
    die("Erişim izniniz bulunmamaktadır!");
}

class Controller extends Application {
    private $_loader, $_controller, $_action, $_view;
    protected $_language, $_appLanguage;

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View();
        $this->_language = new Language();
    }

    protected function view($viewName, $data = false) {
        $this->_view->setLanguage($this->_language);
        $this->_view->render($viewName, $data);
    }

}
