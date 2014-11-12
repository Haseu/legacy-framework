<?php

/**
 * Arquivo: Sql.php (UTF-8)
 *
 * Data: 16/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core\Db;

use Core\Database;
use PDO;

/**
 * Class AbstractModel
 * @package Core
 */
class Sql extends PDO {

    public $table;
    protected $db;
    protected $statement;

    public function __construct() {
        $this->db = new Database();
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

    //Nova versão
    public function select($table = null) {
        
        return new Select(($table) ?: $this->table);
        
    }        //return $this;

    public function insert($tabela = null) {

        $this->tabela = ($tabela != null ? $tabela : $this->tabela);
        $this->operacao = "INSERT ";
        return $this;
    }

    public function update($tabela = null) {

        $this->tabela = ($tabela != null ? $tabela : $this->tabela);
        $this->operacao = "UPDATE ";
        return $this;
    }

    public function delete($tabela = null) {

        $this->tabela = ($tabela != null ? $tabela : $this->tabela);
        $this->operacao = "DELETE ";
        return $this;
    }

    
    public function prepareStatement($sqlObject) {
        $this->statement = $sqlObject->getQuery();
    }
    
    public function execute() {
        $q = $this->db->query($this->statement);
        $q->setFetchMode(Database::FETCH_OBJ);
        return $q->fetchAll();
    }
}
