<?php 

namespace Core;

class Notification {

    public static function push($type, $message, $delay = 0) {
        echo '
        <script>
            $( document ).ready(function() {
                setTimeout(function() {
                    alertify.defaults = {
                        notifier:{
                            delay:2,
                            position:"bottom-left",
                            closeButton: true
                        },
                    }
                    alertify.'. $type . '("'.$message .'");
                }, '. $delay .');
            });
        </script>
        ';
    }

    public static function modal($message, $delay = 0) {
        echo '
        <script>
            $( document ).ready(function() {
                setTimeout(function() {
                    alertify
                    .alert("This is an alert dialog.", function(){});
                }, '. $delay .');
            });
        </script>
        ';
    }

    public static function warning() {

    }

    public static function info() {

    }
    
}