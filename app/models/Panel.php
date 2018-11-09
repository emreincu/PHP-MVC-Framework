<?php
namespace app\models;
use core\Model;
use core\Language;
use core\Validate;
use core\Cookie;
use app\models\Users as UsersModel;

if(!defined('DIRECT_ACCESS')) {
    die("Erişim izniniz bulunmamaktadır!");
}

class Panel extends Model {

    private $_warnings;


    public function updateAdmin($post) {
        dnd($post);
        $userModel = new UsersModel();
        $LANGUAGE = Language::getApp();
        $validation = new Validate();
        $validation->check($post, [
            'email' => [
                'label' => $LANGUAGE['email'],
                'required' => true,
                'email' => true,
                'unique_update' => "users/email/" . Cookie::get("email"),
            ],
            'password' => [
                'label' => $LANGUAGE['your_current_password'],
                'required' => true,
                'min' => 4,
                'max' => 20,
                'equals' => Cookie::get("password") ."/md5"
            ],
            'new_password' => [
                'label' => $LANGUAGE['your_new_password'],
                'required' => true,
                'min' => 4,
                'max' => 20,
                'matches' => 'new_password_repeat'
            ],
            'new_password_repeat' => [
                'label' => $LANGUAGE['new_password_repeat'],
                'required' => true,

            ],
            'name' => [
                'label' => "deneme",
                'reuqired' => true
            ],
            'name2' => [
                'label' => "Denem 2",
                'required' => true
            ],
            'tarih' => [
                'label' => "Tarih",
                'required' => true
            ],
            'secenekler' => [
                'label' => "Seçenkeler",
                'required' => true
            ],
            'saat' => [
                'label' => "Alış Saati",
                'required' => true
            ],
            'file' => [
                'label' => "Resim",
                'required' => true
            ]
        ]);

        if($validation->getPassed()) {
            $this->_warnings = $validation->getHtmlSuccess($LANGUAGE['success_updated']);

            return true;
        }else{
            $this->_warnings = $validation->getHtmlErrors();
            return false;
        }
    }

    public function getWarnings() {
        return $this->_warnings;
    }
}
