<?php

namespace Core;

class Session {

     /**
     * Create new cookie or if cookie already exists then update the cookie.
     * 
     * @param string $name Cookie name.
     * @param mixed $value Cookie content.
     * @param int $expiry Cookie expire time.
     */
    public static function set($name, $value) {
        $_SESSION[$name] = $value;
    }

    /**
     * Get cookie
     * 
     * @param string $name Cookie name.
     * @return mixed
     */
    public static function get($name) {
        return $_SESSION[$name];
    }

    /**
     * Delete cookie
     * 
     * @param string $name Cookie name.
     * @return void
     */
    public static function delete($name) {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Check cookie is exists
     * 
     * @param string $name Cookie name
     * @return bool
     */
    public static function exists($name) {
        return isset($_SESSION[$name]);
    }

    /**
     * Uagent No Version
     * 
     * @return string
     */
    public static function uagent_no_version() {
        $uagent = $_SERVER['HTTP_USER_AGENT'];
        $regx = "/\/[a-zA-Z0-9.]+/";
        $newString = preg_replace($regx, '', $uagent);
        return $newString;
    }

}