<?php

namespace Core;

use Core\Language;
use Core\Database;

class Validation {
    private static $messages, $passed;
    public static function formValidate($items, $post = [], $files = []) {
        self::$messages = [];
        self::$passed = true;

        foreach($items as $name => $rules) {
            if(isset($post[$name])) {
                $value = $post[$name];
                if(gettype($value) === "string") {
                    $value = Input::sanitize($value);
                }
            }else{
                $value = "";
            }
            
            if(isset($files[$name])) {
                $value = $files[$name];
                if($value['size'] == null) {
                    $value = "";
                }
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
                        $value2 = Input::sanitize(trim($post[$rule_value]));
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
                    case 'image':
                        if(!empty($value)) {

                            $width = getimagesize($value['tmp_name'])[0];
                            $height = getimagesize($value['tmp_name'])[1];
                            $size = number_format(($value['size']/1000), 2, '.', '');
                            $ratio = number_format(($width/$height), 2, '.', '');
                            $extension = image_type_to_extension(getimagesize($value['tmp_name'])[2]);
                            $extension = ltrim($extension, '.');

                            foreach($rule_value as $key => $val) {
                                switch($key) {
                                    case 'max_width':
                                        if($val < $width) {
                                            self::addMessage([$name, 'max_width', $val]);
                                        }
                                    break;
                                    case 'min_width':
                                        if($val > $width) {
                                            self::addMessage([$name, 'min_width', $val]);
                                        }
                                    break;
                                    case 'max_height':
                                        if($val < $height) {
                                            self::addMessage([$name, 'max_height', $val]);
                                        }
                                    break;
                                    case 'min_height':
                                        if($val > $height) {
                                            self::addMessage([$name, 'min_height', $val]);
                                        }
                                    break;
                                    case 'max_ratio':
                                        if($val < $ratio) {
                                            self::addMessage([$name, 'max_ratio', $val]);
                                        }
                                    break;
                                    case 'min_ratio':
                                        if($val > $ratio) {
                                            self::addMessage([$name, 'min_ratio', $val]);
                                        }
                                    break;
                                    case 'max_size':
                                        if($val < $size) {
                                            self::addMessage([$name, 'max_size', $val]);
                                        }
                                    break;
                                    case 'min_size':
                                        if($val > $size) {
                                            self::addMessage([$name, 'min_size', $val]);
                                        }
                                    break;
                                    case 'width':
                                        if($val != $width) {
                                            self::addMessage([$name, 'width', $val]);
                                        }
                                    break;
                                    case 'height':
                                        if($val != $height) {
                                            self::addMessage([$name, 'height', $val]);
                                        }
                                    break;
                                    case 'extensions':
                                        $string_val = "\"";
                                        foreach($val as $v) $string_val .= $v .',';
                                        $string_val = rtrim($string_val, ',');
                                        $string_val .= "\"";
                                        if(!in_array($extension, $val)) {
                                            self::addMessage([$name, 'extensions', $string_val]);
                                        }
                                    break;
                                }
                            }
                        }
                    break;
                        
                }
            }
        }
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
            if ($message[1] == "matches") {
                $rule_value = $arrayLanguageSite[$message[2]];
                $label1 = $label;
                $label2 = $rule_value;
            }
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
        $messages = self::translate(self::$messages);
        return json_encode($messages);
    }
}