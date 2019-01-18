<?php

function _vd($data) {
    echo "<pre>";
    if($data) {
        var_dump($data);
    }else{
        var_dump(null);
    }
    echo "</pre>";
}

function _sanitize($text) {
    return htmlentities($text, ENT_QUOTES, 'UTF-8');
}

function _go($address) {
    header("Location:" . $address);
}

function _turn() {
    if(isset($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        header('Location: ' . URL_ROOT);
    }

}

function _pr($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
