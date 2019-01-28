<?php

namespace App\APIs;

use Core\API;
use App\Models\User as userModel;

class User {

    private $user;

    public function __construct() {
        $this->user = new userModel();
    }

    public function getUsers() {
        $users = $this->user->getUsers();
        echo API::JsonEncode($users);
    }

    public function getUserById($id = null) {
        $user = $this->user->getUserById($id);
        echo API::JsonEncode($user);
    }
}