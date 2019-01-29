<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;
use Core\Validation;
use Core\Uploader;

use App\Models\User;

class Home extends Controller {
    
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    public function index() {
        View::setLayout("frontend");
        $user = new User();
        $data['users'] = $user->getUsers();
        $this->view->render("Main/test", $data);
    }

    public function form() {
        $this->view->render("Main/form");
    }

    public function getForm() {
        
        Validation::validate([
            "name" => [
                'required' => true,
                'min' => 3,
                'matches' => "surname"
            ],
            "surname" => [
                'required' => true,
                'max' => 7
            ],
            "checkbox" => [
                'required' => true
            ],
            "city" => [
                'required' => true
            ],
            "photograph" => [
                'required' => true,
                'image' => [
                    'max_width' => 2000,
                    'min_width' => 150,
                    'max_height' => 2500,
                    'min_height' => 10,
                    'max_ratio' => 10,
                    'min_ratio' => 0,
                    'max_size' => 750,
                    'min_size' => 1220,
                    'width' => 1920,
                    'height' => 1080,
                    'extensions' => ['png', 'jpg', 'gif']
                ]
            ]
            ],
            $_POST,
            $_FILES
        );

        if(!Validation::getPassed()) {
            $message =  Validation::getMessages();
            echo "error!";
        }
        
    }
}
