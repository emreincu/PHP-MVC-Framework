<?php

namespace App\models;
use Core\Model;
use Core\Cookie;
use Core\Language;
use Core\Validate;

class Users extends Model {

    public $_loginErrors;

    public function __construct() {
        parent::__construct("users");
    }

    public function login($post) {
        $LANGUAGE = Language::getApp();

        $validation = new Validate();
        if($post) {
            $validation->check($post, [
                'email' => [
                    'label' => $LANGUAGE['email'],
                    'required' => true,
                    'min' => '5',
                    'max' => '50',
                    'email' => true,
                    "is_exists" => "users/text",
                ],
                'password' => [
                    'label' => $LANGUAGE['password'],
                    'required' => true,
                    'is_exists' => "users/md5"
                ]
            ]);

            if($validation->getPassed()) {
                $email = $post['email'];
                $password = md5($post['password']);
                $user = $this->selectFirst([
                    "where" => "email = '$email' AND password = '$password'"
                ]);
                if($this->getCount()) {
                    return true;
                }else{
                    return false;
                }
            }else{
                $this->_loginErrors = $validation->getErrors();
                return false;
            }
        }
    }

    public function getUserByLogin() {
        if($this->isUserLoged()) {
            $email = Cookie::get("email");
            $password = Cookie::get("password");
            return $this->select([
                "where" => "email = '$email' AND password = '$password'"
            ])[0];
        }
        return null;
    }

    public function getUsers() {
        return $this->select();
    }

    public function isUserAdmin() {
        if($this->isUserLoged()) {
            $user = $this->getUserByLogin();
            return ($user["authority"] == "admin") ? true : false;
        }
        return false;
    }

    public function isUserExists($email, $password) {
        $this->select([
            "where" => "email = '$email' AND password = '$password'"
        ]);
        return ($this->getCount()) ? true : false;
    }

    public function isUserLoged() {
        if(Cookie::exists("email") && Cookie::exists("password") ) {
            $email = Cookie::get("email");
            $password = Cookie::get("password");
            return $this->isUserExists($email, $password);
        }
        return false;
    }

    public function getLoginErrors() {
        return $this->_loginErrors;
    }

}
