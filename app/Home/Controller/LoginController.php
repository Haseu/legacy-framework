<?php

/**
 * Arquivo: LoginController.php (UTF-8)
 *
 * Data: 17/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Application\Home\Controller;

use Core\AbstractController;
use Core\Helpers\AuthHelper;
use Application\Models\Usuario;

class LoginController extends AbstractController {

    private $auth;
    private $db;

    public function init() {
        $this->auth = new AuthHelper();
        $this->auth->setLoginControllerAction('login', 'login')->checkLogin('redirect');

        $this->db = new Usuario();
    }

    public function indexAction() {
        echo "login";
    }

    public function loginAction() {
        if ($this->getParam('acao'))
            $this->auth->setTableName('usuarios')
                    ->setUserColumn('login')
                    ->setPasswordColumn('senha')
                    ->setUser($_POST['login'])
                    ->setPassword($_POST['senha'])
                    ->setLoginControllerAction('login', 'index')
                    ->login();

        $this->view->render('login');
    }

    public function logoutAction() {
        $this->auth->setLogoutControllerAction('index', 'index')
                ->logout();
    }
    
    public function testeAction() {
        echo "login:teste";
    }

}
