<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;
use Core\Validation;
    
use App\Models\User;

class Home extends Controller {
    
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    public function index() {
        View::setLayout("frontend");
        $user = new User();
        $yield['users'] = $user->getUsers();
        $this->view->render("Main/test", $yield);
    }

    public function form() {
        $this->view->render("Main/form");
    }

    public function getForm() {
        Validation::validate($_POST, [
            "name" => [
                'label' => "Adı",
                'required' => true,
                'min' => 3,
                'matches' => "surname"
            ],
            "surname" => [
                'label' => "Soyadı",
                'required' => true,
                'max' => 7
            ],
            "checkbox" => [
                'label' => "Checkbox",
                'required' => true
            ]
        ]);
        if(!Validation::getPassed()) {
            _vd(Validation::getMessages());
        }
        //$uploader = new Uploader();
        //$uploader->uploadFile($_FILES, "upload");
    }
}