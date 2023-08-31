<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once FCPATH . 'vendor/tecnickcom/tcpdf/tcpdf.php'; // Include TCPDF library

function generate_pdf($content, $filename = 'default', $size = 'A4', $orientation = 'portrait') {
    $pdf = new TCPDF($orientation, 'mm', $size, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('PDF Document');
    $pdf->SetSubject('Generating PDF using CodeIgniter and TCPDF');
    $pdf->SetKeywords('CodeIgniter, TCPDF, PDF');

    // Set default header and footer data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

    // Set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // Set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Set font
    $pdf->SetFont('times', '', 12);

    // Add a page
    $pdf->AddPage();

    // Set content
    $pdf->writeHTML($content, true, false, true, false, '');

    // Output PDF to browser
    $pdf->Output($filename.'.pdf', 'I');
}
