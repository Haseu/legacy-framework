<?php

/**
 * Arquivo: Error.php (UTF-8)
 *
 * Data: 27/10/2014
 * @version 2.8.1
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core\Helpers;

class ErrorHelper {
   
    private function getError($codigo = false) {

        if ($codigo) {
            if(is_int($codigo)){
                $codigo = $codigo;
            }
        }else{
            $codigo = 'default';
        }
        
        $error['default'] = "Ocorreu um erro e não foi possível carregar a página";
        $error['0001'] = "Acesso restrito";

            if (array_key_exists($codigo, $error)) {
                return $error[$codigo];
            } else {
                return $error['default'];
            }
    }

}
