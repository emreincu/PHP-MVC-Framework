<?php
namespace App\Controllers;
use App\Models\Users;
use Core\Controller;
use Core\Cookie;
use Core\Session;

class Admin extends Controller{
    
    private $_usersModel;

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->_usersModel = new Users();
        $isUserAdmin = $this->_usersModel->isUserAdmin();
        ($isUserAdmin) ? go(URL_ROOT . DS . "panel") : null;

    }

    public function index() {
        $this->view("admin/login");
    }

    public function login() {

        if($_POST) {
            if($this->_usersModel->login($_POST)) {
                $email = $_POST['email'];
                $password = md5($_POST['password']);
                $cookieTime = 60*60;
                if(isset($_POST['remember_me'])) {
                    $cookieTime = 60*60*24;
                }
                Cookie::set("email", $email, $cookieTime);
                Cookie::set("password", $password, $cookieTime);
                $j = json_encode("okey");
            }else{
                $j = json_encode($this->_usersModel->getLoginErrors());
            }
            echo $j;
        }else{
            go(URL_ROOT . DS . "admin");
        }
    }
    
    public function forgot_password() {
        $this->view->setTemplate("forgot_password");
        $this->view->render("admin/admin");
    }

    public function send_forgot_password() {

    }

    public function logout() {
        Cookie::delete("email");
        Cookie::delete("password");
        Session::delete("email");
        Session::delete("password");
        go(URL_ROOT . DS . "admin");
    }


}

 ?>
