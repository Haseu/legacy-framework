<?php

/**
* Arquivo: Produtos.php (UTF-8)
*
* Data: 16/10/2014
* @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
*/

namespace Application\Home\Model;

use Core\Model;

//Model Exemplo

class Produto extends Model{
    public $tabela = "posts";
    
    public function listaProdutos($qtd, $offset = null) {
        return $this->read( null, $qtd, $offset, 'id DESC' );
    }
}