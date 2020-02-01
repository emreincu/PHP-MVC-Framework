<?php

namespace Core;

/**
 * Class Cookie; set, get, update, delete and check the cookie.
 */
class Cookie {
    
    /**
     * Create new cookie or if cookie already exists then update the cookie.
     * 
     * @param string $name Cookie name.
     * @param mixed $value Cookie content.
     * @param int $expiry Cookie expire time.
     */
    public static function set($name, $value, $expiry = 60*60*24) {
        return setCookie($name, $value, (time() + $expiry), DS) ? true : false;
    }

    /**
     * Get cookie
     * 
     * @param string $name Cookie name.
     * @return mixed
     */
    public static function get($name) {
        return self::exists($name) ? $_COOKIE[$name] : null;

    }

    /**
     * Delete cookie
     * 
     * @param string $name Cookie name.
     * @return void
     */
    public static function delete($name) {
        self::set($name, '', time()-1);
    }

    /**
     * Check cookie is exists
     * 
     * @param string $name Cookie name
     * @return bool
     */
    public static function exists($name) {
        return isset($_COOKIE[$name]);
    }
}