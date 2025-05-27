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

//Recuperar la informacion de la facura
$query_facturas = $pdo->prepare("SELECT * FROM tb_facturaciones WHERE estado = '1' "); // consula y seleccion de la tb_informacioons
        $query_facturas ->execute(); //ejecutar
        $facturas = $query_facturas->fetchAll(PDO::FETCH_ASSOC);// vaciar con el forech
        foreach ($facturas as $factura) {
          $id_facturacion=$factura['id_facturacion'];
          $id_informacion=$factura['id_informacion'];
          $nro_factura=$factura['nro_factura'];
          $id_cliente=$factura['id_cliente'];
          $Fecha_emision=$factura['Fecha_emision'];
          $Fecha_ingreso=$factura['Fecha_ingreso'];
          $Hora_ingreso=$factura['Hora_ingreso'];
          $Fecha_salida=$factura['Fecha_salida'];
          $Hora_salida=$factura['Hora_salida'];
          $tiempo=$factura['tiempo'];
          $cuviculo=$factura['cuviculo'];
          $detalle=$factura['detalle'];
          $precio=$factura['precio'];
          $cantidad=$factura['cantidad'];
          $total=$factura['total'];
          $monto_total=$factura['monto_total'];
          $monto_literal=$factura['monto_literal'];
          $user_sesion=$factura['user_sesion'];
          $qr=$factura['qr'];
        }
/////////////////////////////////////////
///////Rescata la informacion del cliente////////
$query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente' AND estado = '1' ");
        $query_clientes ->execute();
        $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datos_clientes as $datos_cliente) {
            $id_cliente = $datos_cliente['id_cliente'];
            $nombre_cliente = $datos_cliente['nombre_cliente'];
            $Dni_Ruc_cliente = $datos_cliente['Dni_Ruc_cliente'];
            $Placa_auto = $datos_cliente['Placa_auto'];
        }
/////////////////////////////////////////




// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79,182), true, 'UTF-8', false);

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
    <b>FACTURA N°</b> E000-'.$nro_factura.'<br>
	-----------------------------------------------------------------------------------
	<div style="text-align: left">
	<b>DATOS DEL CLIENTE</b><br>
	<b>SEÑOR (A):</b> '.$nombre_cliente.'<br>
	<b>DNI/RUC:</b> '.$Dni_Ruc_cliente.'<br>
	<b>Fecha de Emisión:</b> '.$Fecha_emision.'
	-----------------------------------------------------------------------------------<br>
	<b>De: </b>'.$Fecha_ingreso.' <b>Hora:</b> '.$Hora_ingreso.'<br>
	<b>A:  </b> '.$Fecha_salida.' <b>               Hora:</b> '.$Hora_salida.'<br>
	<b>Tiempo:  </b> '.$tiempo.'  en el Cuviculo '.$cuviculo.' 
    -----------------------------------------------------------------------------------<br>
    <table border="1" cellpadding="3">
    <tr>
        <td style="text-align: center" width="99px"><b>Detalle</b></td>
        <td style="text-align: center" width="45px"><b>Precio</b></td>
        <td style="text-align: center" width="45px"><b>Cantidad</b></td>
        <td style="text-align: center" width="45px"><b>Total</b></td>
    </tr>
    <tr>
        <td>'.$detalle.'</td>
        <td style="text-align: center">S/ '.$precio.'.00</td>
        <td style="text-align: center">'.$cantidad.'</td>
        <td style="text-align: center">S/ '.$total.'.00</td>
    </tr>
    </table>
    <p style="text-align: right">
    <b>Monto Total: </b> S/ '.$monto_total.'.00
    </p>
    
    <b>SON:</b>'.$monto_literal.'
    -----------------------------------------------------------------------------------
	<b>USUARIO(A):</b> '.$user_sesion.'<br><br><br><br><br><br><br><br><br>
    <p style="text-align: center">
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

$style = array(
    'border' => 0,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);


$pdf->write2DBarcode($qr,'QRCODE,L',  22,111,35,35, $style);









//Close and output PDF document
$pdf->Output('Factura.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
