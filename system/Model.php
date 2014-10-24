<?php

/**
 * Arquivo: config.php (UTF-8)
 *
 * Data: 16/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core;

use PDO;

class Model {

    public $tabela;
    protected $db;
    protected $sql;
    protected $operacao;
    protected $colunas;
    protected $condicao;
    protected $join;
    protected $joinLeft;
    protected $joinRight;
    protected $from;
    protected $limit;
    protected $order;
    protected $offset;
    protected $distinct;

    public function __construct() {
        $this->db = new PDO('mysql:host=192.168.12.116;dbname=sp_framework;', 'superpay', 'ernet1982');
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
    public function select($tabela = null) {

        $this->setFrom();
        $this->tabela = ($tabela != null ? $tabela : $this->tabela);

        $this->operacao = "SELECT";
        return $this;
    }

    public function from($tabela, $campos = null) {
        $this->setFrom();
        $this->tabela = $tabela;



        if (is_array($campos)) {
            $campos = $this->putCollumnPrefix($tabela, $campos);
            $this->colunas = implode(", ", $campos);
        } else {
            $this->colunas = $campos;
        }

        return $this;
    }

    public function collumns(Array $campos) {
        $campos = $this->putCollumnPrefix($this->tabela, $campos);
        $this->colunas = implode(", ", $campos);
        
        return $this;
    }

    public function where(Array $dados) {
        $controle = 0;
        $where = null;
        foreach ($dados as $ind => $val) {
            if ($controle % 2 == 0):
                $and = "";
            else:
                $and = "AND";
            endif;
            $where .= "{$and} {$ind} = '{$val}' ";
            $controle++;
        }

        $this->condicao .= " WHERE {$where}";
        return $this;
    }

    public function join($tabela, $chaves, Array $campos = null, $orinetacao = "INNER") {

        $tabela_prefix = (is_array($tabela) ? current($tabela) : $tabela);
        $tabela = (is_array($tabela) ? key($tabela) . " as " . current($tabela) : $tabela);

        if (!is_null($campos)) {

            $campos = $this->putCollumnPrefix($tabela_prefix, $campos);
            foreach ($campos as $ind => $val) {
                $this->colunas .= (!is_null($this->colunas) ? ", " : "") . (!is_int($ind) ? $ind : $val) . (!is_int($ind) ? " as " . $val : "");
            }
        }

        $this->join .= "{$orinetacao} JOIN {$tabela} ON ({$chaves}) ";
    }

    public function execute() {
        $this->createQuery();
        $q = $this->db->query($this->sql);
        $q->setFetchMode(PDO::FETCH_OBJ);
        return $q->fetchAll();
    }

    public function getSqlString() {
        $this->createQuery();
        return $this->sql;
    }

    private function setFrom() {
        $this->from = "FROM";
    }
    
    private function distinct() {
        $this->distinct = "DISTINCT";
    }
    
    public function limit($limite) {
        $this->limit = "LIMIT {$limite}";
    }
    
    public function order($ordem) {
        $this->order = "ORDER BY {$ordem}";
    }

    private function putCollumnPrefix($prefix, $campos) {
        foreach ($campos as $ind => $val) {

            if (is_int($ind)) {
                $campos[$ind] = (!is_int($ind) ? $ind : $prefix . "." . $val);
            } else {
                $campos[$prefix . "." . $ind] = $val;
                unset($campos[$ind]);
            }
        }

        return $campos;
    }
    
    private function createQuery() {
        $this->sql = "{$this->operacao} {$this->distinct} {$this->colunas} {$this->from} {$this->tabela} {$this->join} {$this->condicao} {$this->order} {$this->limit} {$this->offset}";
        $this->addApostropheToQuery();
    }
    
    private function addApostropheToQuery() {
        
        $query = explode(" ",  strtr($this->sql, array('(' => '', ')' => '')));
        foreach ($query as $val) {
            if(strpos($val, ".")){
                $t = explode(".", $val);
                strtr($this->sql, array($val => "`".$val."`"));
            }
        }
    }

}
