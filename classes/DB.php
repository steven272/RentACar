<?php

class DB {

    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_result,
            $_count = 0,
            $_totalPages = 0,
            $_perPage = 0,
            $_activePage = 0;

    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=localhost;dbname=rent_a_car', 'root', '');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function action($action, $table, $where = array()) {
        if(count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }

        return false;
    }

    public function join($table, $joint, $fields = array()) {
        $values = '';

        foreach ($fields as $field => $items) {
            foreach($items as $item => $key) {

                $values .= $field . "." . $key . ", ";
                $trimValues = rtrim($values,  ', ');
                $subVales = substr($trimValues, 0, strrpos($trimValues,","));
            }
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = isset($_GET['perPage']) && $_GET['perPage'] <= 50 ? (int)$_GET['perPage'] : 5;

        $this->_activePage = $page;
        $this->_perPage = $perPage;

        $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

        $sql = "SELECT SQL_CALC_FOUND_ROWS {$subVales} FROM `{$table}` INNER JOIN {$joint} ON {$table}.$key = {$joint}.id LIMIT {$start}, {$perPage}";

        if(!$this->query($sql)->error()) {
            $total = $this->_pdo->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
            $this->_totalPages = $pages = ceil($total / $perPage);

            return true;
        }
    }

    public function delete($table, $where) {
        return $this->action('DELETE ', $table, $where);
    }

    public function get($table, $where) {
        return $this->action('SELECT *', $table, $where);
    }

    public function query($sql, $params = array()) {
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if(count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if($this->_query->execute()) {
                $this->_result = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();

            } else {
                $this->_error = true;
            }
        }

        return $this;
    }

    public function insert($table, $fields = array()) {
        if(count($fields)) {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;

            foreach ($fields as $field) {
                $values .= '?';
                if($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

            if(!$this->query($sql, $fields)->error()) {
                return true;
            }
        }
        return false;
    }

    public function activePage() {
        return $this->_activePage;
    }

    public function totalPages() {
        return $this->_totalPages;
    }

    public function perPage() {
        return $this->_perPage;
    }

    public function results() {
        return $this->_result;
    }

    public function first() {
        return $this->results()[0];
    }

    public function error() {
        return $this->_error;
    }

    public function count() {
        return $this->_count;
    }
}