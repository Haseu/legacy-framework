<?php

/**
 * Arquivo: ProdutoController.php (UTF-8)
 *
 * Data: 16/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Application\Home\Controller;

use Core\AbstractController;
use Application\Home\Model\Produto;

class ProdutoController extends AbstractController {

    public function indexAction() {
        $db = new Produto();
        /* $db->insert("posts", array(
          "titulo" => "titulo aqui",
          "resumo" => "resumo aqui",
          "conteudo" => "conteudo aqui",
          "comentarios" => "100"
          )); */

        //$db->read("posts","id=2");

        /* $db->update("posts", array(
          "titulo" => "novo_titulo",
          "conteudo" => "novo conteudo"
          ), "id=2"); */

        //$produtos = new Produto();
        //$db->delete("posts", "id=2");
        $this->view->render('index');
    }

    public function novosAction() {
        $this->view->render('novo');
    }

    public function testeAction() {
        echo "Action Teste";
    }

}
