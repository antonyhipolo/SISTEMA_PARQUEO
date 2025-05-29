<?php
//============================================================+
// File name   : example_004.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 004 for TCPDF class
//               Cell stretching
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Cell stretching
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('../app/templeates/TCPDF-main/tcpdf.php');
include('../app/config.php');

//CARGAR EL ENCABEZADO
$query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' "); // consula y seleccion de la tb_informacioons
        $query_informacions ->execute(); //ejecutar
        $informacions = $query_informacions->fetchAll(PDO::FETCH_ASSOC);// vaciar con el forech
        foreach ($informacions as $informacion) {
          $id_informacion=$informacion['id_informacion'];
          $nombre_parqueo=$informacion['nombre_parqueo'];
          $actividad_de_la_empresa=$informacion['actividad_de_la_empresa'];
          $sucursal=$informacion['sucursal'];
          $direccion=$informacion['direccion'];
          $zona=$informacion['zona'];
          $telefono=$informacion['telefono'];
          $departamento_ciudad=$informacion['departamento_ciudad'];
          $pais=$informacion['pais'];
		}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 004');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$PDF_HEADER_TITLE = $nombre_parqueo;
$PDF_HEADER_STRING = $direccion. ' - TELF: '.$telefono;
$PDF_HEADER_LOGO = 'fortuner211.jpg';

// set default header data
$pdf->SetHeaderData($PDF_HEADER_LOGO , PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('Helvetica', '', 11);

// add a page
$pdf->AddPage();


// create some HTML content
$html = '
<p style="text-align: center"><b> REPORTE DEL LISTADO DE CLIENTES</b></p>
<table border="1" cellpadding="3">
<tr>
<th style="background-color: #c0c0c0; text-align: center; width: 5%;"><b>N°</b></th>
    <th style="background-color: #c0c0c0; text-align: center; width: 40%;"><b>NOMBRE DEL CLIENTES</b></th>
    <th style="background-color: #c0c0c0; text-align: center; width: 30%;"><b>DNI / RUC</b></th>
    <th style="background-color: #c0c0c0; text-align: center; width: 25%;"><b>PLACA VEHICULAR</b></th>
    
</tr>
';
 $contador_cliente = 0;
        $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1' ");
        $query_clientes ->execute();
        $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datos_clientes as $datos_cliente) {
          $contador_cliente = $contador_cliente + 1;
            $id_cliente = $datos_cliente['id_cliente'];
            $nombre_cliente = $datos_cliente['nombre_cliente'];
            $Dni_Ruc_cliente = $datos_cliente['Dni_Ruc_cliente'];
            $Placa_auto = $datos_cliente['Placa_auto'];
            $html .= '
                <tr>
                <td style= "text-align: center">'.$contador_cliente.'</td>
                <td>'.$nombre_cliente.'</td>
                <td style= "text-align: center">'.$Dni_Ruc_cliente.'</td>
                <td style= "text-align: center">'.$Placa_auto.'</td>
                </tr>
            ';
        }

$html .= '
</table>
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//Close and output PDF document
$pdf->Output('example_004.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
