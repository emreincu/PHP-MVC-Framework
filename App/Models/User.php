<?php
namespace App\Models;

use Core\Model;
use Core\Cookie;

class User extends Model{

    public function getUsers() {
        return $this->select("users");
    }

    public function getUserById($id) {
        return $this->select("users", [
            "where" => "id = '{$id}'"
        ]);
    }

    public function addUser($data) {
        return $this->insert("users", $data);
    }

    public function isLoged() {
        return Cookie::exists("emre@gmail.com");
    }

    public function login() {
        
    }

    public function logout() {
        
    }
}
