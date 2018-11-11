<?php
namespace app\controllers;
use Core\Controller;
use App\Models\Users as UsersModel;

class Home extends Controller {
    private $_usersModel;
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->_usersModel = new UsersModel();
    }

    public function index($par = "") {
        $data["users"] = $this->_usersModel->getUsers();
        $this->view("default/other", $data);
        $this->view("default/layouts/header");
    }

    public function add() {
        $fields = [
            "user_name" => "bambam",
            "user_email" => "bamba@gmail.com",
            "user_password" => "143566*ei"
        ];

        $userAdd = $this->_usersModel->addUser($fields);
        if($userAdd) {
            echo "Eklendi!";
        }else{
            echo "Hata Oluştu";
        }
        $this->view("home/index");
    }

    public function update($id) {
        $db = Database::getInstance();
        $fields = [
            "user_name" => "Osman",
            "user_email" => "osman@gmail.com",
            "user_password" => "abcdef"
        ];

        $userAdd = $db->update("users", "user_id", $id, $fields);
        $this->view->render("home/index");
    }

    public function delete($id) {
        $db = Database::getInstance();

        $userAdd = $db->delete("users", "user_id", $id);
        $this->view->render("home/index");
    }

}
