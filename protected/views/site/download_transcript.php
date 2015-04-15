<?php

ini_set('max_execution_time', 120);
$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'mm', 'Letter', true, 'UTF-8', 'transcriptPdf');
$pdf->setSermonDate($sermon->sermon_date);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor(PDF_AUTHOR);
$pdf->SetTitle($sermon->title);
$pdf->SetSubject($sermon->series->title);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// create some HTML content

$html = '<p style="text-align:center;">' . $sermon->title . "</p>";
$pdf->writeHTML($html, true, false, true, false, 'center');
$pdf->SetFont('helvetica', '', 12);

$html = '<p>' . $sermon->getSermonPassage() . '</p>';
$pdf->writeHTML($html, true, false, true, false, 'center');

$html = '<p>Key Verse: ' . $sermon->getKeyVerse() . '</p>';
$pdf->writeHTML($html, true, false, true, false, 'center');

$html = $sermon->getKeyVerseText() . "<br/>";
$pdf->writeHTML($html, true, false, true, false, 'center');

$html = $sermon->text;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
//Close and output PDF document
$filename = date('Ymd', strtotime($sermon->sermon_date)) . "_" . str_replace(":", "_", str_replace(" ", "_", str_replace("&nbsp;", "_", $sermon->getSermonPassage()))) . "_sermon.pdf";

$pdf->Output($filename, 'D');
