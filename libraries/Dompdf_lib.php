<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');
    require_once("dompdf/dompdf_config.inc.php");

    class Dompdf_lib extends Dompdf{

        function createPDF($html, $filename='', $stream=TRUE){
            $this->load_html($html);
            $this->render();
            if ($stream) {
                $this->stream($filename.".pdf");
            } else {
                // return $this->output();
                $name = $filename.".pdf";
                $data = $this->output();
                force_download($name, $data);
            }
        }

        function createPDF2($html, $filename='', $stream=false){
            $this->load_html($html);
            $this->render();
            if ($stream) {
                $this->stream($filename.".pdf");
            } else {
                // return $this->output();
                $name = $filename.".pdf";
                $data = $this->output();
                file_put_contents('/home2/barcam07/public_html/uploads/pdfTemporal/'.$name, $data);
                //force_download($name, $data);
            }
        }

    }
?>
