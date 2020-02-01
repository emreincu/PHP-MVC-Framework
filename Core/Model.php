<?php

namespace Core;

use Core\Database;

/**
 * 
 */
class Model {

    /**
     * @var Database
     */
    private $_database;

    /**
     * Constructor
     */
    public function __construct() {
        $this->_database = Database::getInstance();
    }

    /**
     * Select elements from database
     * 
     * @param string $tables Tables
     * @param array $params
     * @return array
     */
    protected function select($tables, $params = []) {
        return $this->_database->select($tables, $params);
        
    }

    /**
     * Get row count
     * 
     * @return int
     */
    protected function getCount() {
        return $this->_database->getCount();
    }

    /**
     * Select first element from database.
     * 
     * @param string $tables
     * @param array $params
     * @return array
     */
    protected function selectFirst($tables, $params = []) {
        return $this->_database->selectFirst($tables, $params);
    }

    /**
     * Insert data
     * 
     * @param string $tables
     * @param array $fields
     * @return bool
     */
    protected function insert($tables, $fields) {
        $tables = explode(" ", $tables);
        $tables = $tables[0];
        return $this->_database->insert($tables, $fields);
    }

    /**
     * Update data
     * 
     * @param string $tables
     * @param string $key Colum name
     * @param string $value Column value
     * @param array $fields Data
     * @return bool
     */
    protected function update($tables, $key, $value, $fields) {
        $tables = explode(" ", $tables);
        $tables = $tables[0];
        return $this->_database->update($tables, $key, $value, $fields);
    }

    /**
     * Delete data
     * 
     * @param string $tables
     * @param string $key
     * @param string $value
     * @return bool
     */
    protected function delete($tables, $key, $value) {
        $tables = explode(" ", $tables);
        $tables = $tables[0];
        return $this->_database->delete($tables, $key, $value);
    }

    /**
     * Get last inserted item id
     * 
     * @return int
     */
    protected function getLastInsertedID() {
        return $this->_database->getLastID();
    }

}
