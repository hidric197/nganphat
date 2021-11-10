<?php
// Include autoloader
require_once 'npad/lib/dompdf/autoload.inc.php';

// Reference the Dompdf namespace
use Dompdf\Dompdf;

// Instantiate and use the dompdf class
$dompdf = new Dompdf();

// Load HTML content
$fileContent = mb_convert_encoding(file_get_contents( 'export.php' ) , "HTML-ENTITIES", "UTF-8");

$dompdf->load_html($fileContent, 'UTF-8');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Bao_gia_NganPhat.pdf");

?>