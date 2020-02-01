<?php

namespace App\APIs;
use App\Models\UserModel;

class User extends \Core\API {

    /**
     * @var UserModel
     */
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function getUsers() {
       
        $users = $this->userModel->getAll();

        echo $this->json($users, 200);
    }
}