<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\User;

class Home extends Controller {
    
    public function __construct($controller, $action) {
        parent::__construct($controller, $action);

    }

    public function index() {
        $user = new User();
        $yield['users'] = $user->getUsers();
        $this->view->render("Main/test", $yield);
    }

}
