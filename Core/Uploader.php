<?php

namespace Core;

class Uploader {
    public static function uploadFile($files, $inputName, $directory = "") {
        if(count($files[$inputName]['name']) > 0) {
            
            foreach ($files[$inputName]['name'] as $fileName) {
                if($fileName != null) {
                }
            }
        }
    }
}