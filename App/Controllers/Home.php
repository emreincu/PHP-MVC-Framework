<?php
namespace App\Controllers;

use Core\Controller;

class Home extends Controller {
    
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    public function index() {
        $this->view->setLayout("frontend");
        $this->view->render("Main/test");
    }

    public function form() {
        $this->view->render("Main/form");
    }

    public function getForm() {
    }
}
