<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Arquivo: authHelper.php (UTF-8)
 *
 * Data: 17/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core\Helpers;

use Core\AbstractModel;
use Core\Request;
use Core\Helpers\SessionHelper;
use Core\Helpers\RedirectorHelper;

/**
 * Class AuthHelper
 * @package Core\Helpers
 */
class AuthHelper {

    protected $sessionHelper;
    protected $redirectorHelper;
    protected $request;
    protected $tableName;
    protected $userColumn;
    protected $passwordColumn;
    protected $user;
    protected $password;
    protected $loginModule = "base";
    protected $loginController = "index";
    protected $loginAction = "index";
    protected $logoutController = 'index';
    protected $logoutAction = 'index';

    public function __construct() {
        $this->sessionHelper = new SessionHelper();
        $this->redirectorHelper = new RedirectorHelper();
        $this->request = new Request();
        return $this;
    }

    public function setTableName($val) {
        $this->tableName = $val;
        return $this;
    }

    public function setUserColumn($val) {
        $this->userColumn = $val;
        return $this;
    }

    public function setPasswordColumn($val) {
        $this->passwordColumn = $val;
        return $this;
    }

    public function setUser($val) {
        $this->user = $val;
        return $this;
    }

    public function setPassword($val) {
        $this->password = $val;
        return $this;
    }

    public function setLoginModule($module) {
        $this->loginModule = $module;
        return $this;
    }

    public function setLoginController($controller) {
        $this->loginController = $controller;
        return $this;
    }

    public function setLoginAction($action) {
        $this->loginAction = $action;
        return $this;
    }

    public function setLogoutControllerAction($controller, $action) {
        $this->logoutController = $controller;
        $this->logoutAction = $action;
        return $this;
    }

    public function login() {
        $db = new AbstractModel();
        $db->tabela = $this->tableName;
        //$where = $this->userColumn . "='" . $this->user . "' AND " . $this->passwordColumn . "='" . $this->password . "'";
        //$sql = $db->read($where, '1');
        $db->select()->where(array($this->userColumn => $this->user, $this->passwordColumn => $this->password))->limit(1);
        $sql = $db->execute();

        if (count($sql) > 0) {
            $this->sessionHelper->set("userAuth", true)
                    ->set("userData", $sql[0]);
        } else {
            $this->redirectorHelper->toRoute(array("module" => "login", "controller" => "login"));
            echo("Usuário não existe.");
        }

        $this->redirectorHelper->toRoute(array('module' => $this->loginModule, 'controller' => $this->loginController, 'action' => $this->loginAction));
        return $this;
    }

    public function logout() {
        $this->sessionHelper->delete("userAuth")
                ->delete("userData");
        $this->redirectorHelper->toRoute(array('module' => $this->loginModule, 'controller' => $this->loginController, 'action' => $this->loginAction));
        return $this;
    }

    public function checkLogin($action) {
        switch ($action) {
            case "boolean":
                if (!$this->sessionHelper->check("userAuth"))
                    return false;
                else
                    return true;
                break;
            case "redirect":
                $teste = $this->request->getController();
                $teste1 = $this->loginController;
                $teste2 = $this->request->getAction();
                $teste3 = $this->loginAction;
                if (!$this->sessionHelper->check("userAuth"))
                    if ($this->request->getController() != $this->loginController)
                        $this->redirectorHelper->toRoute(array('module' => $this->loginModule, 'controller' => $this->loginController, 'action' => $this->loginAction));
                break;
            case "stop":
                if (!$this->sessionHelper->check("userAuth"))
                    exit;
                break;
        }
    }

    public function userData($key) {
        $s = $this->sessionHelper->get("userData");
        return $s[$key];
    }

}
