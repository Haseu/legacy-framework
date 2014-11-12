<?php

/**
 * Arquivo: LoginController.php (UTF-8)
 *
 * Data: 17/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Application\Login\Controller;

use Core\AbstractController;
use Core\Helpers\AclHelper;
use Core\Helpers\AuthHelper;
use Application\Login\Model\Usuario;
use Application\Login\Model\Grupo;

/**
 * Class LoginController
 * @package Application\Home\Controller 
 */
class LoginController extends AbstractController {

    private $auth;

    public function init() {

        $this->acl = new AclHelper();
        $this->auth = new AuthHelper();
        $this->setAclRole();
    }

    public function indexAction() {
        print_r($_SESSION);
        $this->view->render('login');
    }

    public function loginAction() {
        $this->auth->setTableName('usuarios')
                ->setUserColumn('login')
                ->setPasswordColumn('senha')
                ->setUser($_POST['login'])
                ->setPassword($_POST['senha'])
                ->setLoginModule('home')
                ->setLoginController('index')
                ->setLoginAction('index')
                ->login();
    }

    public function logoutAction() {
        $this->auth->setLoginModule('login')->setLoginController('login')->setLoginAction('index')
                ->logout();
    }

    public function testeAction() {
        echo "login:teste";
    }

    private function setAclRole() {
        //We add some roles 
        $grupos = new Grupo();
        $result = $grupos->getGrupos();


        $this->acl->addRole('grand_father');
        $this->acl->addRole('dad', 'grand_father');
        $this->acl->addRole('mom');
        $this->acl->addRole('son', array('dad', 'mom'));
    }

}
