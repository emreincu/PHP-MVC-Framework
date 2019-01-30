<?php
namespace App\Controllers;

use Core\Controller;
use Core\View;
use Core\Validation;
use Core\Uploader;
use Core\Mail;

use App\Models\User;

class Home extends Controller {
    
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
    }

    public function sendMail() {
        $mail = new Mail();

        $mail->init([
            'charset'   => 'UTF-8', // Mail dil kodlaması. Varsayılan olarak 'UTF-8' değerini alır.
            'server'    => 'mail.alanadi.com', // SMTP Giden mail sunucusu
            'username'  => 'test@alanadi.com', // SMTP kullanıcı adı
            'password'  => '12345' // SMTP kullanıcı şifresi
        ]);

        $mail->from('gonderen@alanadi.com', 'John Doe'); // Gönderici E-Posta adresi ve ismi tanımlanıyor
        $mail->from('gonderen@alanadi.com'); // Sadece gönderici E-Posta adresi tanımlanıyor.

        $mail->to('alici@alanadi.com', 'John Doe'); // Alıcı E-Posta adresi ve ismi tanımlanıyor
        $mail->to('alici@alanadi.com'); // Sadece alıcı E-Posta adresi tanımlanıyor.

        $mail->subject('Titan Mini Framework Mail Plugin');

        $mail->message('Mail İçeriği');

        $mail->send();
        echo "test";
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
            ], $_POST, $_FILES
        );

        if(!Validation::getPassed()) {
            $message =  Validation::getMessages();
            _vd($message);
        }
        
    }
}
