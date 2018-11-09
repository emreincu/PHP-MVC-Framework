<?php
namespace core;
use core\Language;
use core\Database;
use core\Input;

if(!defined('DIRECT_ACCESS')) {
    die("Erişim izniniz bulunmamaktadır!");
}

class Validate {
    private $_passed = false, $_errors = [], $_db = null;

    public function __construct() {
        $this->_db = Database::getInstance();
    }

    public function check($source, $items = []) {
        $this->_error = [];
        foreach($items as $item => $rules) {
            $item = sanitize($item);
            $label = $rules['label'];
            if(!isset($source[$item])) {
                $this->addError(["required", $item, $label]);
            }else{
                foreach($rules as $rule => $ruleValue) {
                    if(is_array($source[$item])) {
                        foreach($source[$item] as $si_key => $si_val) {
                            $source[$item][$si_key] = Input::sanitize(trim($si_val));
                        }
                    }else{
                        $value = Input::sanitize(trim($source[$item]));
                    }

                    if($rule == "required" && empty($value)) {

                        $this->addError(["required", $item, $label]);
                    } elseif (!empty($value)) {
                        switch ($rule) {
                            case 'min':
                                if(strlen($value) < $ruleValue) {
                                    $this->addError(["min", $item, $label, $ruleValue]);
                                }
                                break;
                            case 'max':
                                if(strlen($value) > $ruleValue) {
                                    $this->addError(["max", $item, $label, $ruleValue]);
                                }
                                break;

                            case 'matches':
                                if($value != $source[$ruleValue]) {
                                    $item1 = $item;
                                    $item2 = $items[$item]["matches"];
                                    $label1 = $label;
                                    $label2 = $items[$ruleValue]['label'];
                                    $this->addError(["matches", $item1, $label1, $item2, $label2]);
                                }
                                break;
                            case 'unique':
                                $check = $this->_db->select($ruleValue, [
                                    "where" => "{$item} = '{$value}'"
                                ]);

                                if($this->_db->getCount()) {
                                    $this->addError(["unique", $item, $label]);
                                }
                                break;
                            case 'unique_update':
                                $t = explode("/", $ruleValue);
                                $table = $t[0];
                                $key = $t[1];
                                $val = $t[2];
                                $query = $this->_db->select("{$table}", [
                                    "where" => "{$key} != '{$val}' AND {$item} = '{$value}'"
                                ]);
                                if($this->_db->getCount()) {
                                    $this->addError(["unique_update", $item, $label]);
                                }
                                break;
                            case 'is_exists':
                                $t = explode("/", $ruleValue);
                                $table = $t[0];
                                $type = $t[1];

                                if($type == "md5") {
                                    $value = md5($value);
                                }elseif($type=="text") {
                                    $value = $value;
                                }

                                $check = $this->_db->select($table, [
                                    "where" => "{$item} = '{$value}'"
                                ]);

                                if($this->_db->getCount() == 0) {
                                    $this->addError(["is_exists", $item, $label]);
                                }
                                break;
                            case 'equals':
                                $t = explode("/", $ruleValue);
                                $tValue = $t[0];
                                $type = $t[1];

                                if($type == "md5") {
                                    $value = md5($value);
                                }
                                if($tValue != $value) {
                                    $this->addError(["equals", $item, $label]);
                                }
                                break;
                            case 'numeric':
                                if(!is_numeric($value)) {
                                    $this->addError(["numeric", $item, $label]);
                                }
                                break;
                            case 'email':
                                if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {

                                    $this->addError(["email", $item, $label]);
                                }
                                break;
                        }
                    }
                }
            }
        }

    }

    public function addError($error) {
        $this->_errors[] = $error;
    }

    public function getPassed() {
        if(count($this->_errors) == 0) {
            return true;
        }else{
            return false;
        }
    }

    private $_translatedErrors;
    public function translateErrors() {
        $langValidate = Language::getValidate();
        foreach($this->_errors as $error) {
            $type = $error[0];
            switch ($type) {
                case 'required':
                    $item = $error[1];
                    $label = $error[2];

                    $str = str_replace(":", '$', $langValidate["required"]);
                    eval("\$str = \"$str\";");
                    $this->_translatedErrors[] = [$item, $str];
                    break;
                case 'min':
                    $item = $error[1];
                    $label = $error[2];
                    $value = $error[3];

                    $str = str_replace(":", '$', $langValidate["min"]);
                    eval("\$str = \"$str\";");
                    $this->_translatedErrors[] = [$item, $str];
                    break;
                case 'max':
                    $item = $error[1];
                    $label = $error[2];
                    $value = $error[3];

                    $str = str_replace(":", '$', $langValidate["max"]);
                    eval("\$str = \"$str\";");
                    $this->_translatedErrors[] = [$item, $str];
                    break;
                case 'matches':
                    $item1 = $error[1];
                    $label1 = $error[2];
                    $item2 = $error[3];
                    $label2 = $error[4];

                    $str = str_replace(":", '$', $langValidate["matches"]);
                    eval("\$str = \"$str\";");
                    $this->_translatedErrors[] = [$item1, $str];
                    break;
                    /* V */
                case 'unique':
                    $item = $error[1];
                    $label = $error[2];

                    $str = str_replace(":", '$', $langValidate["unique"]);
                    eval("\$str = \"$str\";");
                    $this->_translatedErrors[] = [$item, $str];
                    break;
                case 'unique_update':
                    $item = $error[1];
                    $label = $error[2];

                    $str = str_replace(":", '$', $langValidate["unique_update"]);
                    eval("\$str = \"$str\";");
                    $this->_translatedErrors[] = [$item, $str];
                    break;
                case 'is_exists':
                    $item = $error[1];
                    $label = $error[2];

                    $str = str_replace(":", '$', $langValidate["is_exists"]);
                    eval("\$str = \"$str\";");
                    $this->_translatedErrors[] = [$item, $str];
                    break;
                case 'equals':
                    $item = $error[1];
                    $label = $error[2];
                    $str = str_replace(":", '$', $langValidate["equals"]);
                    eval("\$str = \"$str\";");
                    $this->_translatedErrors[] = [$item, $str];
                    break;
                case 'numeric':
                    $item = $error[1];
                    $label = $error[2];

                    $str = str_replace(":", '$', $langValidate["numeric"]);
                    eval("\$str = \"$str\";");
                    $this->_translatedErrors[] = [$item, $str];
                    break;
                case 'email':
                    $item = $error[1];
                    $label = $error[2];

                    $str = str_replace(":", '$', $langValidate["email"]);
                    eval("\$str = \"$str\";");
                    $this->_translatedErrors[] = [$item, $str];
                    break;
            }
        }
    }


    public function getErrors() {
        self::translateErrors();
        return $this->_translatedErrors;
    }

    public function getHtmlErrors() {
        $html = "<ul class='list-group mb-3 mt-3'>";
        $jquery = "";
        foreach($this->getErrors() as $error) {
            $html .= "<li class='list-group-item alert alert-danger list-group-item-danger pb-1 pt-1 mb-1'><small><i class='fas fa-exclamation-circle'></i></small> " . $error[1] ."<button type='button' class='close' data-dismiss='alert'>×</button></li>";
            $jquery .= "<script>jQuery('document').ready(function(){jQuery('#" . $error[0] . "').addClass('border-danger');})</script>";
        }
        $html .= "</ul>" . $jquery;

        return $html;
    }

    public function getHtmlSuccess($message) {

        $html = "<ul class='list-group mb-3 mt-3'>";
        $html .= "<li class='list-group-item alert alert-success list-group-item-success pb-2 pt-2 mb-1'>" . $message ."<button type='button' class='close' data-dismiss='alert'>×</button></li>";
        $html .= "</ul>";

        return $html;
    }

}
