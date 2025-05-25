<?php
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
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79,179), true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema_Parqueo');
$pdf->SetTitle('SISTEMA_PARQUEO');
$pdf->SetSubject('SISTEMA_PARQUEO');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5, 5, 5);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('Helvetica', '', 7);

// add a page
$pdf->AddPage();



// create some HTML content
$html = '
<div>
	<p style="text-align: center">
	<b>'.$nombre_parqueo.' </b><br>
	<b>'.$actividad_de_la_empresa.'</b><br> 
	SUCURSAL<br>
	<b>N° '.$sucursal.'</b><br>
	'.$direccion.' <br>
	<b>Zona:</b> '.$zona.'<br>
	<b>Teléfono:</b> '.$telefono.'<br>
	'.$departamento_ciudad.'-'.$pais.'<br>
    -----------------------------------------------------------------------------------
    <b>FACTURA N°</b> E001-1<br>
	-----------------------------------------------------------------------------------
	<div style="text-align: left">
	<b>DATOS DEL CLIENTE</b><br>
	<b>SEÑOR (A):</b> HIPOLO MARCELO ANTONY<br>
	<b>DNI/RUC:</b> 74690220<br>
	<b>Fecha de Emisión:</b> 74690220
	-----------------------------------------------------------------------------------<br>
	<b>De: </b>24/05/2025 <b>Hora:</b> 20:48<br>
	<b>A:  </b> 24/05/2025 <b>Hora:</b> 22:48<br>
	<b>Tiempo:  </b> 2 horas en el Cuviculo 10
    -----------------------------------------------------------------------------------<br>
    <table border="1" cellpadding="3">
    <tr>
        <td style="text-align: center" width="99px"><b>Detalle</b></td>
        <td style="text-align: center" width="45px"><b>Precio</b></td>
        <td style="text-align: center" width="45px"><b>Cantidad</b></td>
        <td style="text-align: center" width="45px"><b>Total</b></td>
    </tr>
    <tr>
        <td>Servicio de Parqueo de 2 horas</td>
        <td style="text-align: center">S/ 10.00</td>
        <td style="text-align: center">1</td>
        <td style="text-align: center">S/ 10.00</td>
    </tr>
    </table>
    <p style="text-align: right">
    <b>Monto Total: </b> S/ 10.00
    </p>
    
    <b> SON:</b>Diez 00/100 Soles.<br>
    
    -----------------------------------------------------------------------------------
	<b>USUARIO (A):</b> HIPOLO MARCELO
    <p style="text-align: center">
    <img src="https://ninos.kiddle.co/images/d/d7/Commons_QR_code.png" width="100px" alt="">
    </p>
    <p style="text-align: center">"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO SERÁ SANCIONADO PENALMENTE DE ACUERDO A LEY"
    </p>
    <p style="text-align: center"><b>GRACIAS POR SU PREFERENCIA!</b></p>
	</div>
	</p>

</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');










//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
