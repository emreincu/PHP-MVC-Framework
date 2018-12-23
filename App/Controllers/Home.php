<?php
namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use Core\Cookie;
use Core\Language;
use Core\View;
use Core\Notification;

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


}
