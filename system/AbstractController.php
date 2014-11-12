<?php

/**
 * Arquivo: AbstractController.php (UTF-8)
 *
 * Data: 16/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core;

use Core\Request;
use Core\View;
use Core\Redirect;

abstract class AbstractController {

    protected $view;
    protected $redirect;

    public function __construct() {
        $this->setView();
        $this->setRedirect();
    }

    abstract public function indexAction();

    public function init() {}

    //Verificar se vai utilizar
    protected function loadModel($model) {
        $modelPath = ROOT . 'Model' . DS . $model . '.php';
        
        if(is_readable($modelPath)){
            require_once $modelPath;
            $model = new $model();
            return $model;
        }else{
            throw new Exception('Erro: carregamento de modelo');
        }
    }
    
    //Verificar se vai utilizar
    protected function getLibrary($library) {
        
        $libraryPath = ROOT . 'library' . DS . $library . '.php';
        
        if(is_readable($libraryPath)){
            require_once $libraryPath;
        }else{
            throw new Exception('Erro: Biblioteca não encontrada');
        }
    }

    private function setView() {
        $this->view = new View(new Request);
    }
    
    private function setRedirect(){
        $this->redirect = new Redirect();
    }

}
