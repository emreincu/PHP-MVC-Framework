<?php

namespace Core;

class Annotation {
    private $reflector;
    const REGEX_ANNOTATION = '/@(?P<name>\w+)\s+(?P<value>.+)/';

    private function getComments() {
        $commentsArray = null;
        $classComments = $reflector->getDocComment();
        return preg_match_all(self::REGEX_ANNOTATION, $classComments, $commentsArray);
    }

    private function setReflector($class) {
        $this->reflector = new ReflectionClass('\\app\\controllers\\'.$class); 
    }

    private function getReflector() {
        return $this->reflector;
    }

    private function getClass($file) {
        $class = explode(".", $file);
        return reset($class);
    }

    private function getFiles($directory) {
        $files = scandir($directory);
        return array_diff($files, array('.', '..'));
    }
}