<?php

class TranscriptPDF extends TCPDF {

    var $_username;
    var $_sermon_date;

    //Page header
    public function Header() {
        // Logo
        $this->SetFont('helvetica', 'B', 20);
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        // Page number
        $html = 'Sermon Date: ' . date('F j, Y', strtotime($this->_sermon_date)) . "<br/>Downloaded: " . date('F j, Y');
        $this->SetFont('helvetica', '', 8);
        $this->writeHTMLCell(60, 10, '', '', $html, 0, 0, false, true, 'L', true);

        $this->SetFont('helvetica', '', 10);
        $this->MultiCell(55, 10, $this->getAliasNumPage(), 0, 'C', 0, 0, '85', '', true);
        $this->SetFont('helvetica', '', 8);
        $html = "&copy;" . date("Y") . " IIT UBF. All rights reserved.<br/>http://www.iitubf.org";
        $this->writeHTMLCell(55, 10, '145', '', $html, 0, 0, false, true, 'R', true);
    }

    public function setUserName($un) {
        $this->_username = $un;
    }

    public function setSermonDate($dc) {
        $this->_sermon_date = $dc;
    }

}

?>
