<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
* Arquivo: Grupos.php (UTF-8)
*
* Data: 28/10/2014
* @version 2.8.1
* @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
*/

namespace Application\Login\Model;

use Core\AbstractModel;
use Zend\Db\Sql\Sql;
/**
 * Class Grupos
 * @package Application\Login\Model
 */
class Grupo extends AbstractModel{
    public $table = "grupos";
    
    public function getGrupos() {
        $sql = new Sql($this->db);
        $select = $sql->select();
        $select->from($this->table);
        $teste = $sql->getTable();
        print_r($teste);
        //echo $sql->getSqlStringForSqlObject($select);
        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        //print_r($result->count());
        foreach ($result as $row) {
            print_r($row['nome']);
            echo "<br>";
        }
        die();
    }
}