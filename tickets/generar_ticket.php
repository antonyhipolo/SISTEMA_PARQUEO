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
//CARGAR INFORMACION DEL TICKET
$query_tickets = $pdo->prepare("SELECT * FROM tb_tickes WHERE estado = '1' "); // consula y seleccion de la tb_informacioons
        $query_tickets ->execute(); //ejecutar
        $tickets = $query_tickets->fetchAll(PDO::FETCH_ASSOC);// vaciar con el forech
        foreach ($tickets as $ticket) {
            $id_ticket = $ticket['id_ticket'];
            $nombres = $ticket['nombres'];
            $Dni_ruc = $ticket['Dni_ruc'];
            $Cuviculo = $ticket['Cuviculo'];
            $Fecha_ingreso = $ticket['Fecha_ingreso'];
            $Hora_ingreso = $ticket['Hora_ingreso'];
            $user_sesion = $ticket['user_sesion'];
		}


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79,80), true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 002');
$pdf->SetSubject('TCPDF Tutorial');
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
	<div style="text-align: left">
	<b>DATOS DEL CLIENTE</b><br>
	<b>SEÑOR (A):</b> '.$nombres.'<br>
	<b>DNI/RUC:</b> '.$Dni_ruc.'
	-----------------------------------------------------------------------------------<br>
	<b>Cuviculo de Parqueo: </b>'.$Cuviculo.'<br>
	<b>Fecha de Ingreso:</b>'.$Fecha_ingreso.'<br>
	<b>Hora de Ingreso:</b> '.$Hora_ingreso.'
	-----------------------------------------------------------------------------------<br>
	<b>USUARIO (A):</b>'.$user_sesion.'
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
