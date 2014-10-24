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

use Core\Model;
use Core\Helpers\SessionHelper;
use Core\Helpers\RedirectorHelper;

class AuthHelper {

    protected $sessionHelper;
    protected $redirectorHelper;
    protected $tableName;
    protected $userColumn;
    protected $passwordColumn;
    protected $user;
    protected $password;
    protected $loginController = "index";
    protected $loginAction = "index";
    protected $logoutController = 'index';
    protected $logoutAction = 'index';

    public function __construct() {
        $this->sessionHelper = new SessionHelper();
        $this->redirectorHelper = new RedirectorHelper();
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

    public function setLoginControllerAction($controller, $action) {
        $this->loginController = $controller;
        $this->loginAction = $action;
        return $this;
    }

    public function setLogoutControllerAction($controller, $action) {
        $this->logoutController = $controller;
        $this->logoutAction = $action;
        return $this;
    }

    public function login() {
        $db = new Model();
        $db->tabela = $this->tableName;
        $where = $this->userColumn . "='" . $this->user . "' AND " . $this->passwordColumn . "='" . $this->password . "'";
        $sql = $db->read($where, '1');

        if (count($sql) > 0) {
            $this->sessionHelper->createSession("userAuth", true)
                    ->createSession("userData", $sql[0]);
        } else {
            $this->redirectorHelper->goToControllerAction("login", "login");
            echo("Usuário não existe.");
        }

        $this->redirectorHelper->goToControllerAction($this->loginController, $this->loginAction);
        return $this;
    }

    public function logout() {
        $this->sessionHelper->deleteSession("userAuth")
                ->deleteSession("userData");
        $this->redirectorHelper->goToControllerAction($this->logoutController, $this->logoutAction);
        return $this;
    }

    public function checkLogin($action) {
        switch ($action) {
            case "boolean":
                if (!$this->sessionHelper->checkSession("userAuth"))
                    return false;
                else
                    return true;
                break;
            case "redirect":
                if (!$this->sessionHelper->checkSession("userAuth"))
                    if ($this->redirectorHelper->getCurrentController() != $this->loginController || $this->redirectorHelper->getCurrentAction() != $this->loginAction)
                        $this->redirectorHelper->goToControllerAction($this->loginController, $this->loginAction);
                break;
            case "stop":
                if (!$this->sessionHelper->checkSession("userAuth"))
                    exit;
                break;
        }
    }

    public function userData($key) {
        $s = $this->sessionHelper->selectSession("userData");
        return $s[$key];
    }

}
