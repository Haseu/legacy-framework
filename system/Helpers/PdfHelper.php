<?php

/**
 * Arquivo: pdfHelper.php (UTF-8)
 *
 * Data: 27/10/2014
 * @version 2.8.1
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core\Helpers;

use Library\mpdf\mpdf;

class PdfHelper {

    public $mpdf;

    public function __construct($mode = '', $format = 'A4', $default_font_size = 0, $default_font = '', $mgl = 15, $mgr = 15, $mgt = 16, $mgb = 16, $mgh = 9, $mgf = 9, $orientation = 'P') {

        $this->mpdf = new mPDF();
        $this->mpdf->mPDF($mode = '', $format = 'A4', $default_font_size = 0, $default_font = '', $mgl = 15, $mgr = 15, $mgt = 16, $mgb = 16, $mgh = 9, $mgf = 9, $orientation = 'P');
    }

    public function convert_html($string) {
        $arr_procura = array('&aacute;', '&agrave;', '&atilde;', 'â', 'ä', 'õ', 'ò', '&oacute;', 'è', '&eacute;', 'ê', 'ë', 'ì', 'í', 'ï', '&ccedil;', '�?', 'À', 'Ã', 'Â', 'Ä', 'Õ', 'Ò', 'Ó', 'È', 'É', 'Ê', 'Ë', 'Ì', '�?', '�?', 'Ç', 'º', 'Ô', 'ô');
        $arr_troca = array('&aacute;', '&agrave;', '&atilde;', '&acirc;', '&auml;', '&otilde;', '&ograve;', '&oacute;', '&egrave;', '&eacute;', '&ecirc;', '&euml;', '&igrave;', '&iacute;', '&iuml;', '&ccedil;', '&Aacute;', '&Agrave;', '&Atilde;', '&Acirc;', '&Auml;', '&Otilde;', '&Ograve;', '&Oacute;', '&Egrave;', '&Eacute;', '&Ecirc;', '&Euml;', '&Igrave;', '&Iacute;', '&Iuml;', '&Ccedil;', '&deg;', '&Ocirc;', '&ocirc;');
        return str_replace($arr_procura, $arr_troca, $string);
    }

}
