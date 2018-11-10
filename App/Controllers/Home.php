<?php
namespace app\controllers;
use Core\Controller;
use App\Models\Users as UsersModel;

/**
* @Route anasayfa
*/
class Home extends Controller {
    private $_usersModel;
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);
        $this->_usersModel = new UsersModel();
    }

    /**
    * @Route Yeni-method, denemeMethod
    */
    public function index($par = "") {
        $data["users"] = $this->_usersModel->getUsers();
        $data["form"] =  "";
        $this->view("default/other", $data);
        $this->view("default/layouts/header");
    }

    public function deneme() {
        $form = new Form("");
        $form->start_div(6, 6, 6, 6);
        $form->add_date("ad", "Adınız", "2000-01-01");
        $form->add_text("ad", "Adınız", "Adınızı Giriniz", "Emre");
        $form->end_div();
        $form->start_div(6, 6, 6, 6);
        $form->add_password("ad", "Adınız");
        $form->add_textarea("ad", "Adınız", "dsds");
        $form->end_div();
        $form->add_time("ad", "Adınız", "12:00");
        $form->add_checkbox("ad2", "Adınız", "12:00");
        $form->add_checkbox("ad3", "Adınız", "12:00");
        $form->add_checkbox("ad23", "Adınız", "12:00");
        $form->add_checkbox("ad24", "Adınız", "12:00");
        $form->add_radio("ad4", "ad12", "Adınız", "12:00");
        $form->add_radio("ad4", "ad13", "Adınız", "12:00");
        $form->add_radio("ad4", "ad14", "Adınız", "12:00");
        $form->add_radio("ad4", "ad15", "Adınız", "12:00");
        $form->add_radio("ad4", "ad16", "Adınız", "12:00");
        $form->add_radio("ad4", "ad17", "Adınız", "12:00");
        $form->add_radio("ad4", "ad18", "Adınız", "12:00");
        $form->add_radio("ad4", "ad19", "Adınız", "12:00");
        $form->add_submit("Gönder");
        $data["form"] = $form->get_form("denemeAction", "post", "-", "upload");
        $this->view("default/layouts/header");
        $this->view("default/other", $data);
        $this->view("default/layouts/footer");
    }

    /**
    * @Route ekle, arti
    */
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
