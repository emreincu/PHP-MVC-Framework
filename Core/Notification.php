<?php 

namespace Core;

class Notification {

    public static function push($type, $message) {
        echo '
        <script>
            alertify.'. $type . '("'.$message .'");
        </script>
        ';
    }

    public static function danger() {

    }

    public static function warning() {

    }

    public static function info() {

    }
    
}