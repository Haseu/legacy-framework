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
use Core\Helpers\PdfHelper;
use Application\Login\Model\Usuario;

/**
 * Class IndexController
 * @package Application\Home\Controller 
 */
class IndexController extends AbstractController {

    private $db;

    public function init() {
        
    }

    public function indexAction() {
        //$dados = $this->getParams();
        //$email = new EmailHelper();
        //$email->enviaEmail();
        //We add some roles 
        /*$this->acl->addRole('avô');
        $this->acl->addRole('pai', 'avô');
        $this->acl->addRole('mãe');
        $this->acl->addRole('filho', array('pai', 'mãe'));

        //We add some resources
        $this->acl->addResource('casa_avo');
        $this->acl->addResource('casa_pai');
        $this->acl->addResource('casa_mae');
        $this->acl->addResource('minha_casa');

        //We set some rules
        $this->acl->allow('avô', 'casa_avo');
        $this->acl->allow('pai', 'casa_pai');
        $this->acl->allow('mãe', 'casa_mae');*/

        /*echo 'Filho pode entrar na casa do pai?<br />';
        var_dump($this->acl->isAllowed('filho', 'casa_avo')); //Deve ser true 

        echo 'Mãe pode entrar na casa do avô? Ele não gosta dela<br />';
        var_dump($this->acl->isAllowed('mãe', 'casa_avo')); //False */
        
        //Testes de queries
        $this->db = new Usuario();
        $sql = $this->db->select();
        //$sql->collumns(array("nome", "login", "senha"));
        //$sql->join('posts', 'usuarios.id = posts.usuario_id', array('resumo', 'titulo' => 'teste_titulo'), "LEFT");
        //$sql->join(array('telefones' => 't'), 'usuarios.id = t.usuario_id', array('numero' => 'numeroTelefone'), "LEFT");
        //$sql->where(array('usuarios.id' => '1'));
        //$sql->limit("1");
        //$sql->order("usuarios.id DESC");
        //echo $sql->getSqlString();
        //$usuario = $sql->execute();
        
        //$this->db = new Usuario();
        //$sql = $this->db->update();
        //echo $sql->getSqlString();

        $teste['usuario'] = $usuario;
        $teste['acl'] = '';

        //Testes de layout
        //$this->view->layout('Home/View/layout/layout_1');
        //$this->view->setTerminate(true);
        $this->view->render('index', $teste);

        //$redirector = new RedirectorHelper();
        /* $redirector->setUrlParameter('nome','Andre')
          ->setUrlParameter('idade','33')
          ->goToUrl('http://www.google.com.br'); */
        //echo "Action index";
    }

    public function testeAction() {
        echo "Action Teste";
    }

}
