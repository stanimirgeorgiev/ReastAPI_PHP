<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RestAPI\DB;

/**
 * Description of SimpleDB
 *
 * @author ACER
 */


class SimpleDB {

    private $db = null;
    protected $connection = 'default';
    private $sql = null;
    private $stmt = null;
    private $logSql = null;
    private $params = [];
    protected $logger = null;

    public function __construct($connection = NULL) {
        if ($connection instanceof \PDO) {
            $this->db = $connection;
        } else if ($connection != NULL) {
            $this->db = \RestAPI\App::getInstance()->getConnectionToDB($connection);
            $this->connection = $connection;
        } else {
            $this->db = \RestAPI\App::getInstance()->getConnectionToDB($this->connection);
        }
    }

    /**
     * 
     * @param type $sql
     * @param type $params
     * @param type $pdoOptions
     * @return \GTFramework\DB\SimpleDB 
     */
    public function prepare($sql,$params = [], $pdoOptions = []) {
        LOG < 2 ?: $this->logger->log('parepare in SimpleDB called with sql: ' . $sql  . ' pdoOptions: ' . print_r($pdoOptions,TRUE));
        $this->stmt = $this->db->prepare($sql, $pdoOptions);
        $this->params = $params;
        $this->sql = $sql;
        $this->logSql = $sql;
        return $this;
    }
    
    public function beginTransaction() {
        $this->db->beginTransaction();
        return $this;
    }

    public function commit() {
        $this->db->commit();
        return $this;
    }
    
    /**
     * 
     * @param type $params
     * @return \GTFramework\DB\SimpleDB
     */
    public function execute($params = []) {
        LOG < 2 ?: $this->logger->log('execute in SimpleDB called with params: ' . print_r($params,TRUE));
        if (isset($params)) {
            $this->params = $params;
        }
        if ($this->logSql) {
            LOG < 2 ?: $this->logger->log('Executed sql: ' . $this->logSql . ' with params: ' . print_r($params,TRUE));
        }
        $this->stmt->execute($this->params);
        return $this;
    }

    public function fetchAllAssoc() {
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function fetchRowAssoc() {
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetchAllNum() {
        return $this->stmt->fetchAll(\PDO::FETCH_NUM);
    }

    public function fetchRowNum() {
        return $this->stmt->fetch(\PDO::FETCH_NUM);
    }

    public function fetchAllObj() {
        return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function fetchRowObj() {
        return $this->stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function fetchAllColumn($column) {
        return $this->stmt->fetchAll(\PDO::FETCH_COLUMN, $column);
    }

    public function fetchRowColumn($column) {
        return $this->stmt->fetch(\PDO::FETCH_BOUND, $column);
    }

    public function fetchAllClass($class) {
        return $this->stmt->fetchAll(\PDO::FETCH_CLASS, $class);
    }

    public function fetchRowClass($class) {
        return $this->stmt->fetch(\PDO::FETCH_BOUND, $class);
    }

    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }

    public function getAffectedRows() {
        return $this->stmt->rowCount();
    }

    public function getSTMT() {
        return $this->stmt;
    }

}
