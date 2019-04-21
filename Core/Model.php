<?php

namespace Core;

use Core\Database;

class Model {

    private $_db;

    public function __construct() {
        $this->_db = Database::getInstance();
    }

    protected function select($tables, $params = []) {
        return $this->_db->select($tables, $params);
        
    }

    protected function getCount() {
        return $this->_db->getCount();
    }

    protected function getRowCount($tables, $params = []) {
        return $this->_db->getRowCount($tables, $params);
    }

    protected function selectFirst($tables, $params = []) {
        return $this->_db->selectFirst($tables, $params);
    }

    protected function insert($tables, $fields) {
        $tables = explode(" ", $tables);
        $tables = $tables[0];
        return $this->_db->insert($tables, $fields);
    }

    protected function update($tables, $key, $value, $fields) {
        $tables = explode(" ", $tables);
        $tables = $tables[0];
        return $this->_db->update($tables, $key, $value, $fields);
    }

    protected function delete($tables, $key, $value) {
        $tables = explode(" ", $tables);
        $tables = $tables[0];
        return $this->_db->delete($tables, $key, $value);
    }

    protected function getLastInsertedID() {
        return $this->_db->getLastID();
    }
}
