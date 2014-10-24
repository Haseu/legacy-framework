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

abstract class AbstractController {

    protected $view;

    public function __construct() {
        $this->setView();
    }

    abstract public function indexAction();

    public function init() {
        
    }

    private function setView() {
        $this->view = new View(new Request);
    }

}
