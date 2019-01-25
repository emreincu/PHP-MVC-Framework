<?php

namespace Core;

use Core\Language;
use Core\Database;

class Validation {
    private static $messages, $passed;
    public static function validate($source, $items = []) {
        self::$messages = [];
        self::$passed = true;

        foreach($items as $name => $rules) {
            if(isset($source[$name])) {
                $value = $source[$name];
                if(gettype($value) === "string") {
                    $value = Input::sanitize($value);
                }
            }else{
                $value = "";
            }

            foreach($rules as $rule_key => $rule_value) {
                switch($rule_key) {
                    case 'required':
                        if(empty($value)) {
                            self::addMessage([$name, 'required', $rule_value]);
                        }
                    break;
                    case 'min':
                        if(strlen($value) < $rule_value) {
                            self::addMessage([$name, 'min', $rule_value]);
                        }
                    break;
                    case 'max':
                        if(strlen($value) > $rule_value) {
                            self::addMessage([$name, 'max', $rule_value]);
                        }
                    break;
                    case 'matches':
                        $value2 = Input::sanitize(trim($source[$rule_value]));
                        if($value !== $value2) {
                            self::addMessage([$name, 'matches', $rule_value]);
                        }
                    break;
                    case 'unique':
                        $table = $rule_value[0];
                        $key = $rule_value[1];
                        $db = Database::getInstance();
                        $db->selectFirst($table, [
                            "where" => "$key = '$value'"
                        ]);
                        if($db->getCount() != 0) {
                            self::addMessage([$name, 'unique', $rule_value]);
                        }
                    break;
                    case 'exists':
                        $table = $rule_value[0];
                        $key = $rule_value[1];
                        $db = Database::getInstance();
                        $db->selectFirst($table, [
                            "where" => "$key = '$value'"
                        ]);
                        if($db->getCount() == 0) {
                            self::addMessage([$name, 'exists', $rule_value]);
                        }
                    break;
                    case 'numeric':
                        if(!is_numeric($value)) {
                            self::addMessage([$name, 'numeric', $rule_value]);
                        }
                    break;
                    case 'email':
                        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            self::addMessage([$name, 'email', $rule_value]);
                        }
                    break;
                }
            }
        }


        /*
        foreach($source as $name => $value) {
            $value = Input::sanitize($value);
            $rules = $items[$name];
            foreach($rules as $rule_key => $rule_value) {
                switch($rule_key) {
                    case 'required':
                        if(empty($value)) {
                            self::addMessage([$name, 'required', $rule_value]);
                        }
                    break;
                    case 'min':
                        if(strlen($value) < $rule_value) {
                            self::addMessage([$name, 'min', $rule_value]);
                        }
                    break;
                    case 'max':
                        if(strlen($value) > $rule_value) {
                            self::addMessage([$name, 'max', $rule_value]);
                        }
                    break;
                    case 'matches':
                        $value2 = Input::sanitize(trim($source[$rule_value]));
                        if($value !== $value2) {
                            self::addMessage([$name, 'matches', $rule_value]);
                        }
                    break;
                    case 'unique':
                        $table = $rule_value[0];
                        $key = $rule_value[1];
                        $db = Database::getInstance();
                        $db->selectFirst($table, [
                            "where" => "$key = '$value'"
                        ]);
                        if($db->getCount() != 0) {
                            self::addMessage([$name, 'unique', $rule_value]);
                        }
                    break;
                    case 'exists':
                        $table = $rule_value[0];
                        $key = $rule_value[1];
                        $db = Database::getInstance();
                        $db->selectFirst($table, [
                            "where" => "$key = '$value'"
                        ]);
                        if($db->getCount() == 0) {
                            self::addMessage([$name, 'exists', $rule_value]);
                        }
                    break;
                    case 'numeric':
                        if(!is_numeric($value)) {
                            self::addMessage([$name, 'numeric', $rule_value]);
                        }
                    break;
                    case 'email':
                        if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            self::addMessage([$name, 'email', $rule_value]);
                        }
                    break;
                }
            }
        }
        */
    }

    private static function translate($messages) {
        $result = [];
        $languageValidate = Language::getValidate(Cookie::get("language"));
        $languageSite = Language::getLanguage(Cookie::get("language"));
        $arrayLanguageValidate = (array)$languageValidate;
        $arrayLanguageSite = (array)$languageSite;
        foreach($messages as $message) {
            $rule_value = end($message);
            $label = $arrayLanguageSite[$message[0]];
            $item = $message[0];
            $translated = $arrayLanguageValidate[$message[1]];
            $translated = str_replace(":_", "$",$translated);
            $evaluated = eval("\$translated = \"$translated\";");
            $result[$item] = $translated;
        }
        return $result;
    }

    private static function addMessage($message) {
        self::$passed = false;
        self::$messages[] = $message;
    }

    public static function getPassed() {
        return self::$passed;
    }

    public static function getMessages() {
        return self::translate(self::$messages);
    }
}