<?php

/**
 * Arquivo: config.php (UTF-8)
 *
 * Data: 16/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

/**
 * Class AbstractModel
 * @package Core
 */
class AbstractModel extends AbstractTableGateway{

    public $table;
    protected $db;

    public function __construct() {
        $this->db = new Adapter(array(
            'driver' => 'Mysqli',
            'dbname' => DB_NAME,
            'username' => DB_USER,
            'password' => DB_PASS,
            'host' => DB_HOST
        ));
        
        $this->db = new Adapter(array(
            'driver' => 'Pdo',
            'dsn'    => 'mysql:dbname='.DB_NAME.';host='.DB_HOST,
            'username' => DB_USER,
            'password' => DB_PASS
        ));
    }

    /*
      public function insert(Array $dados) {
      $campos = implode(", ", array_keys($dados));
      $valores = "'" . implode("', ' ", array_values($dados)) . "'";
      return $this->db->query(" INSERT INTO `{$this->tabela}` ({$campos}) VALUES ({$valores}) ");
      }

      public function read($where = null, $limit = null, $offset = null, $orderby = null) {
      $where = ($where != null ? "WHERE {$where}" : "");
      $limit = ($limit != null ? "LIMIT {$limit}" : "");
      $offset = ($offset != null ? "OFFSET {$offset}" : "");
      $orderby = ($orderby != null ? "ORDER BY {$orderby}" : "");

      $q = $this->db->query(" SELECT * FROM  `{$this->tabela}` {$where} {$orderby} {$limit} {$offset}");
      $q->setFetchMode(PDO::FETCH_OBJ);
      return $q->fetchAll();
      }

      public function update(Array $dados, $where) {
      foreach ($dados as $ind => $val) {
      $campos[] = "{$ind} =  '{$val}'";
      }

      $campos = implode(", ", $campos);
      $this->db->query(" UPDATE `{$this->tabela}`  SET {$campos} WHERE {$where}");
      }

      public function delete($where) {
      $this->db->query(" DELETE FROM `{$this->tabela}` WHERE {$where} ");
      } */

}
