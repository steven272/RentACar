<?php

class Datatable {

    private $_db;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function getDataTable($table, $joint, $fields = array()) {
        if(!$this->_db->join($table, $joint, $fields)) {
            throw new Exception("There was problem getting dataTable information...");
        }
    }

    public function data() {
        return $this->_db->results();
    }
}