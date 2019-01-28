<?php
namespace App\Models;

use Core\Model;
use Core\Cookie;

class User extends Model{

    public function __construct() {
        parent::__construct("users");
    }

    public function getUsers() {
        return $this->select();
    }

    public function getUserById($id) {
        return $this->select([
            "where" => "id = '{$id}'"
        ]);
    }

    public function isLoged() {
        return Cookie::exists("emre@gmail.com");
    }

    public function login() {
        
    }

    public function logout() {
        
    }
}
