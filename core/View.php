<?php
namespace core;

if(!defined('DIRECT_ACCESS')) {
    die("Erişim izniniz bulunmamaktadır!");
}

class View {
    private $_title, $_description, $_keywords, $_author, $_language;

    public function render($viewName, $yield = false) {

        $viewPath = DIR_ROOT . DS . 'app' . DS . 'views' . DS . $viewName . '.php';

        !(file_exists($viewPath)) ? die("The View \"" . $viewName ."\" does not exists!") : null;

        if($yield) {
            extract($yield);
        }

        if($this->_language != null) {
            $LANGUAGE = $this->_language->getApp();
            $_language_label = $this->_language->getLabel();
            $_language_shortLabel = $this->_language->getShortLabel();
            $_language_link = $this->_language->getLink();
        }
        include($viewPath);
    }

    public function CONTENT($type) {
        if(isset($this->_layouts[$type]))
            return $this->_layouts[$type];
        else
            return false;
    }

    public function START($type) {
        $this->_layouts[$type] = $type;
        ob_start();
    }

    public function END() {
        $this->_layouts[end($this->_layouts)] = ob_get_clean();
    }


    public function getTitle() {
        return $this->_title;
    }

    public function getDescription() {
        return $this->_description;
    }

    public function getKeywords() {
        return $this->_keywords;
    }

    public function getAuthor() {
        return $this->_author;
    }

    public function setTitle($title) {
        $this->_title = $title;
    }

    public function setDescription($description) {
        $this->_description = $description;
    }

    public function setKeywords($keywords) {
        $this->_keywords = $keywords;
    }

    public function setAuthor($author) {
        $this->_author = $author;
    }

    public function setLanguage($language) {
        $this->_language = $language;
    }

}
