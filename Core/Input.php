<?php

namespace Core;

/**
 * 
 */
class Input {
    
    /**
     * Sanitize input
     * 
     * @param array
     * @return array
     */
    public static function sanitize($input) {
        return htmlentities($input, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Get input
     * 
     * @param array $data Inputs
     * @param string|int $inp
     * @return array
     */
    public static function get($data, $input) {
        if(isset($data[$input])) {
            return self::sanitize($data[$input]);
        }
        return null;
    }

 }