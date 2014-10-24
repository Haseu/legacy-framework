<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
* Arquivo: UploadHelper.php (UTF-8)
*
* Data: 17/10/2014
* @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
*/

namespace Core\Helpers;

class UploadHelper{
    protected $path = 'uploads/';
    protected $file;
    protected $fileName;
    protected $fileTempName;

    public function setPath( $path ) {
        $this->path = $path;
        return $this;
    }
    
    public function setFile( $file ) {
        $this->file = $file;
        $this->setFileName();
        $this->setFileTempName();
        return $this;
       
    }
    
    public function setFileName() {
        $this->fileName = $this->file['name'];
    }
    
    public function setFileTempName() {
        $this->fileTempName = $this->file['tmp_name'];
    }
    
    public function upload() {
        if(move_uploaded_file($this->fileTempName, $_SERVER['DOCUMENT_ROOT'] . $this->path . $this->fileName))
            return true;
        else
            return false;
    }
}