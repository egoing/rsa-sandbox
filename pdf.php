<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// read html 
ob_start();
//be sure this file exists, and works outside of web context etc.)
require("/var/www/html/pdf.html");
$html = ob_get_clean();

if (isset($_GET['name'])) {
	$html = str_replace('{{ $name }}', $_GET['name'], $html);
}

if (isset($_GET['type']) && $_GET['type'] == 'pdf') {
	// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	$dompdf->load_html($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream('certificate.pdf');
} 

echo $html; 
