<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use Core\Cookie;
use Core\Language;

class Home extends Controller {
    
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);

    }

    public function index() {

        $language = new Language();
        $languageData = $language->getLanguageFile(Cookie::get("language"));
        echo $languageData->hello;

        $user = new User();
        $yield['users'] = $user->getUsers();
        $this->view->render("Main/test", $yield);
    }


}
