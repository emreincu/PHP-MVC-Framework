<?php
namespace app\controllers;
use core\Controller;

/**
* @Route iletisim
*/

class Contact extends Controller {
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    public function index() {
        dnd ($this->language);
        $this->view->render("home/index");
    }
    public function form() {
        $this->view->render("home/contact-form");
    }
    public function send() {
        $this->view->render("home/contact-form");
    }
}
