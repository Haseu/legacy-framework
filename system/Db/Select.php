<?php

/**
 * Arquivo: Select.php (UTF-8)
 *
 * Data: 30/10/2014
 * @version 2.8.1
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core\Db;

class Select {

    protected $table;
    protected $operation = "SELECT";
    protected $columns = '*';
    protected $where;
    protected $join;
    protected $from = 'FROM';
    protected $limit;
    protected $order;
    protected $offset;
    protected $distinct;

    public function from($table) {
        if ($table) {
            $this->table = $table;
        }
        $this->columns = $table.".".$this->columns;
        return $this;
    }

    public function collumns(Array $fields) {
        $fields = $this->putCollumnPrefix($this->table, $fields);
        $this->columns = implode(", ", $fields);

        return $this;
    }

    public function where(Array $data) {
        $control = 0;
        $where = null;
        foreach ($data as $ind => $val) {
            if ($control % 2 == 0):
                $and = "";
            else:
                $and = "AND";
            endif;
            $where .= "{$and} {$ind} = '{$val}' ";
            $control++;
        }

        $this->where .= " WHERE {$where}";
        return $this;
    }

    public function join($table, $keys, Array $fields = null, $orientation = "INNER") {

        $table_prefix = (is_array($table) ? current($table) : $table);
        $table = (is_array($table) ? $this->addApostrophe(key($table)) . " as " . current($table) : $this->addApostrophe($table));

        if (!is_null($fields)) {

            $fields = $this->putCollumnPrefix($table_prefix, $fields);
            foreach ($fields as $ind => $val) {
                $this->columns .= (!is_null($this->columns) ? ", " : "") . (!is_int($ind) ? $ind : $val) . (!is_int($ind) ? " as " . $val : "");
            }
        }

        $this->join .= "{$orientation} JOIN {$table} ON ({$keys}) ";
    }

    public function getSqlString() {
        $this->getQuery();
        return $this->sql;
    }

    private function distinct() {
        $this->distinct = "DISTINCT";
    }

    public function limit($limit) {
        $this->limit = "LIMIT {$limit}";
    }

    public function order($order) {
        $this->order = "ORDER BY {$order}";
    }

    private function putCollumnPrefix($prefix, $fields) {
        foreach ($fields as $ind => $val) {

            if (is_int($ind)) {
                $fields[$ind] = (!is_int($ind) ? $ind : $prefix . "." . $val);
            } else {
                $fields[$prefix . "." . $ind] = $val;
                unset($fields[$ind]);
            }
        }

        return $fields;
    }

    public function getQuery() {

        $this->sql = "{$this->operation} {$this->distinct} {$this->columns} {$this->from} `{$this->table}` {$this->join} {$this->where} {$this->order} {$this->limit} {$this->offset}";
        $this->addApostropheToQuery();
        return $this->sql;
    }

    private function addApostropheToQuery() {

        $query = explode(" ", strtr($this->sql, array('(' => '', ')' => '')));
        $query = array_filter($query);
        foreach ($query as $val) {
            if (!strpos($val, "`")) {
                if (strpos($val, ".")) {
                    $r = explode(".", $val);
                    $this->sql = str_replace($val, "`" . $r[0] . "`." . $r[1], $this->sql);
                }
            }
        }
    }

    private function addApostrophe($table) {
        return "`" . $table . "`";
    }

}
