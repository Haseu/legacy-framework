<?php

/**
 * Arquivo: IndexController.php (UTF-8)
 *
 * Data: 16/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Application\Home\Controller;

use Core\AbstractController;
use Core\Helpers\RedirectorHelper;
use Application\Home\Model\Usuario;


class IndexController extends AbstractController {
    
    
    private $db;
    
    public function init() {
        
    }

    public function indexAction() {        
        //$dados = $this->getParams();
        //$email = new EmailHelper();
        //$email->enviaEmail();
        
        //Testes de queries
        $this->db = new Usuario();
        $sql = $this->db->select();
        $sql->collumns(array("nome","login","senha"));
        $sql->join('posts', 'usuarios.id = posts.usuario_id', array('resumo','titulo' => 'teste_titulo'),"LEFT");
        $sql->join(array('telefones' => 't'), 'usuarios.id = t.usuario_id',array('numero' => 'numeroTelefone'),"LEFT");
        $sql->where(array('usuarios.id' => '1'));
        $sql->limit("1");
        $sql->order("usuarios.id DESC");
        //echo $sql->getSqlString();
        $usuario = $sql->execute();
        
        $teste['usuario'] = $usuario;
        
        //Testes de layout
        //$this->view->layout('Home/View/layout/layout_1');
        //$this->view->setTerminate(true);
        $this->view->render('index', $teste);
        
        //$redirector = new RedirectorHelper();
        /*$redirector->setUrlParameter('nome','Andre')
                   ->setUrlParameter('idade','33')
                   ->goToUrl('http://www.google.com.br');*/
        //echo "Action index";
    }
    
    public function testeAction() {
        echo "Action Teste";
    }
}
