<?php

namespace App\APIs;

use Core\Language;
use Core\Cookie;
use Core\Response;
use Core\Validation;
use App\Models\User as userModel;

class User {

    private $user;

    public function __construct() {
        $this->user = new userModel();
    }

    public function getUsers() {
        Response::setHeader("Access-Control-Allow-Origin" , "*");
        Response::setHeader("Content-Type" , "application/json; charset=UTF-8");
        Response::setHeader("Access-Control-Allow-Credentials" , "true");
        Response::setHeader("Content-Type" , "application/json");

        $users = $this->user->getUsers();

        if(!empty($users)) {
            Response::setStatus(200);
            extract($users);
            echo json_encode($users);
        }else{
            Response::setStatus(404);
        }
    }

    public function getUserById($id = null) {
        Response::setHeader("Access-Control-Allow-Origin" , "*");
        Response::setHeader("Content-Type" , "application/json; charset=UTF-8");
        Response::setHeader("Access-Control-Allow-Credentials" , "true");
        Response::setHeader("Content-Type" , "application/json");

        $user = $this->user->getUserById($id);

        if(!empty($user)) {
            Response::setStatus(200);
            extract($user);
            echo json_encode($user);
        }else{
            Response::setStatus(404);
        }
    }

    public function createUser() {
        Response::setHeader("Access-Control-Allow-Origin" , "*");
        Response::setHeader("Content-Type" , "application/json; charset=UTF-8");
        Response::setHeader("Access-Control-Allow-Methods" , "PUT");
        Response::setHeader("Access-Control-Max-Age" , "3600");
        Response::setHeader("Access-Control-Allow-Headers" , "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
        $language = Language::getAPI();

        $data = (array)json_decode(file_get_contents("php://input"));
        if($data == null) {
            Response::setStatus(503);
            echo json_encode(array("message" => (string) $language->unable_to_create_item));
            exit;
        }
        
        Validation::validate([
            "id" => [
                "required" => true,
                "numeric" => true
            ],
            "email" => [
                "reuqired" => true,
                "email" => true
            ]
        ], $data);

        
        if(Validation::getPassed()) {
            if($this->user->addUser($data)) {
                Response::setStatus(201);
                echo json_encode(array("message" => (string) $language->item_was_created));
            }else{
                Response::setStatus(503);
                echo json_encode(array("message" => (string) $language->unable_to_create_item));
            }
        }else{
            Response::setStatus(400);
            echo json_encode(array("message" => Validation::getMessages()));
            exit;
        }
    }
}