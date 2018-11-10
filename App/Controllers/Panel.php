<?php
namespace App\controllers;
use Core\Controller;
use Core\Form;
use Core\Cookie;
use App\Models\Users as UserModel;
use App\Models\Panel as PanelModel;
use App\Models\Uploads as UploadsModel;

class Panel extends Controller{
    private
        $_panelModel,
        $_usersModel,
        $_uploadsModel;

    public function __construct($controller, $action) {
        parent::__construct($controller, $action);

        $this->_usersModel = new UserModel();
        $isUserAdmin = $this->_usersModel->isUserAdmin();

        if(!$isUserAdmin) {
            go(URL_ROOT . DS . "admin" . DS . "logout");
        }else{
            $this->_panelModel = new PanelModel();
            $this->_uploadsModel = new UploadsModel();
        }

    }

    public function index() {
        $this->view("panel/layouts/header");
        $this->view("panel/layouts/navbar");
        $this->view("panel/layouts/side_menu");
        $this->view("panel/panel");
        $this->view("panel/layouts/footer");
    }

    public function admin() {
        $LANGUAGE = $this->_language->getApp();

        $form_warnings = null;
        if($_POST) {
            $this->_panelModel->updateAdmin($_POST);
            $form_warnings = $this->_panelModel->getWarnings();
        }

        $form = new Form($_POST);
        $form->add_submit($LANGUAGE["update"], "right");
        $form->add_warnings($form_warnings);
        $form->add_text("email", $LANGUAGE["your_email"], $LANGUAGE["your_email"], Cookie::get('email'), "false");
        $form->add_password("password", $LANGUAGE["your_current_password"], $LANGUAGE["your_current_password"], 0);
        $form->add_password("new_password", $LANGUAGE["your_new_password"], $LANGUAGE["your_new_password"], 0);
        $form->add_password("new_password_repeat", $LANGUAGE["new_password_repeat"], $LANGUAGE["new_password_repeat"], 0);

        $form->start_box("name", "Deneme Group", "left-to-right");
        $form->add_checkbox("name[]", "id1", "label1", "value1", true);
        $form->add_checkbox("name[]", "id2", "label2", "value2");
        $form->add_checkbox("name[]", "id3", "label3", "value3", true);
        $form->end_box();

        $form->start_box("name2", "Deneme Group 2", "top-to-bottom");
        $form->add_radio("name2", "id11", "label1", "value11");
        $form->add_radio("name2", "id21", "label2", "value21");
        $form->add_radio("name2", "id31", "label3", "value31");
        $form->end_box();

        $form->add_date("tarih", "Alış Tarihi");
        $form->add_time("saat", "Alış Saati");

        $form->start_select("secenekler", "Deneme");
        $form->add_option("secenekler", "", "Hoopala");
        $form->add_option("secenekler", "deneme1", "Deneme 1");
        $form->add_option("secenekler", "deneme2", "Deneme 2");
        $form->add_option("secenekler", "deneme3", "Deneme 3");
        $form->add_option("secenekler", "deneme4", "Deneme 4");
        $form->end_select();

        $form->add_link("index.html", "Deneme", "btn btn-warning");
        $form->add_file("file", "dsa", "dsssds");
        $form->add_submit($LANGUAGE["update"], "right");
        $data["form"] = $form->get_form();

        $data["title"] = $LANGUAGE['admin_settings'];

        $this->view("panel/layouts/header");
        $this->view("panel/layouts/navbar");
        $this->view("panel/layouts/side_menu");
        $this->view("panel/form", $data);
        $this->view("panel/layouts/footer");
    }

    public function uploads($type = "images", $page = 1) {
        $LANGUAGE = $this->_language->getApp();
        $data["title"] = $LANGUAGE["uploads"];

        $data["uploads"] = $this->_uploadsModel->getUploadsByCategorie($type, $page);
        $data["lastPage"] = $this->_uploadsModel->getLastPage();
        $data["currentPage"] = $page;
        $data["type"] = $type;

        $this->view("panel/layouts/header");
        $this->view("panel/layouts/navbar");
        $this->view("panel/layouts/side_menu");
        $this->view("panel/uploads", $data);
        $this->view("panel/layouts/footer");
    }


    public function new_upload() {
        $LANGUAGE = $this->_language->getApp();
        $data["title"] = $LANGUAGE["upload_new_files"];

        $this->view("panel/layouts/header");
        $this->view("panel/layouts/navbar");
        $this->view("panel/layouts/side_menu");
        $this->view("panel/new_upload", $data);
        $this->view("panel/layouts/footer");
    }

    public function upload_delete($id) {
        $j = json_encode("fail");
        if($this->_uploadsModel->deleteUploadbyId($id)) {
            $j = json_encode("okey");
        }
        echo $j;
    }

    public function upload_file() {
        $this->_uploadsModel->upload($_FILES);
    }

}
