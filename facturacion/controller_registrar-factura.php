<?php
include('../app/config.php');
include('literal.php');

$id_informacion = $_GET['id_informacion'];
$nro_factura = $_GET['nro_factura'];
$id_cliente = $_GET['id_cliente'];

/// fecha de emision
date_default_timezone_set("America/Lima");
$fechaemision_fac = date("y-m-d");
$Fecha_emision = $fechaemision_fac;

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");

//fecha de ingreso y salida
$Fecha_ingreso = $_GET['Fecha_ingreso'];
$Hora_ingreso = $_GET['Hora_ingreso'];
$Fecha_salida = date('d/m/y');
$Hora_salida = date('H:i');

///////////////////calculo por días////////////////////////////////////////
$Fecha_salida_ára_calcular = date('Y/m/d');
$dato1 = new DateTime($Fecha_ingreso);
$dato2 = new DateTime($Fecha_salida_ára_calcular);
$días_calculado = $dato1->diff($dato2);
$días_calculado->days;
$día_imprimir_dif = $días_calculado->days;

///////////////////////////////////////////////////////////////////////////

//////////////////calcula el tiempo del parqueo////////////////////////////
$c_hora_ingreso = strtotime($Hora_ingreso); 
$c_hora_salida = strtotime($Hora_salida);
$diferencia_de_horas = ($c_hora_salida - $c_hora_ingreso)/3600;
$hora_calculado = (int)$diferencia_de_horas;
$diferencia_minutos = ($c_hora_salida - $c_hora_ingreso)/60;
$calculando =$hora_calculado * 60;
$minutos_calculado = $diferencia_minutos-$calculando;
if ($día_imprimir_dif =="0") {
     $tiempo =$hora_calculado." horas  y  ".$minutos_calculado." minutos";
} else {
    $tiempo =$día_imprimir_dif." días con ". $hora_calculado." horas  y  ".$minutos_calculado." minutos";
}

////////////////////////////////////////////////////////////////////////////




$cuviculo = $_GET['cuviculo'];
$detalle = "Servicio de Parqueo de ".$tiempo;

/////////////////////////calcula el precio del cliente en horas/////////////////////
$query_precios_horas = $pdo->prepare("SELECT * FROM tb_precios WHERE cantidad = '$hora_calculado' AND  detalle IN ('HORA', 'HORAS') AND estado = '1' ");
        $query_precios_horas ->execute();
        $datos_precios_horas = $query_precios_horas->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datos_precios_horas as $datos_precios_hora) {
        $precios_horas = $datos_precios_hora['precio'];
        }
////////////////////////////////////////////////////////////////////////////




/////////////////////////calcula el precio del cliente en días/////////////////////
$precios_días =0;
$query_precios_días = $pdo->prepare("SELECT * FROM tb_precios WHERE cantidad = '$día_imprimir_dif' AND detalle IN ('DIA', 'DIAS') AND estado = '1' ");
        $query_precios_días ->execute();
        $datos_precios_días = $query_precios_días->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datos_precios_días as $datos_precios_día) {
           $precios_días = $datos_precios_día['precio'];
        }
////////////////////////////////////////////////////////////////////////////////////
$precio_final = $precios_horas + $precios_días;


$cantidad = "1";

$total =($precio_final * $cantidad);



$monto_total = $total;

$monto_literal = numtoletras($monto_total);

$user_sesion = $_GET['user_sesion'];

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
$qr = "Factura realizada por el sistema de parqueo <b>TONY_TECH S.A.C.</b>  al <b>CLIENTE:</b> ".$nombre_cliente."  con <b>DNI/ RUC:</b> ".$Dni_Ruc_cliente."
con el vehiculo de <b>PLACA:</b> ".$Placa_auto." y esta factura se genero con la <b>FECHA DE EMISION:</b> ".$Fecha_emision." a <b>HORAS:</b> ".$Hora_salida."";


$sentencia = $pdo->prepare('INSERT INTO tb_facturaciones
(id_informacion, nro_factura, id_cliente, Fecha_emision, Fecha_ingreso, Hora_ingreso, Fecha_salida, Hora_salida, tiempo, cuviculo, detalle, precio, cantidad, total, monto_total, monto_literal, user_sesion, qr, fyh_creacion, estado)
VALUES ( :id_informacion, :nro_factura, :id_cliente, :Fecha_emision, :Fecha_ingreso, :Hora_ingreso, :Fecha_salida, :Hora_salida, :tiempo, :cuviculo, :detalle, :precio, :cantidad, :total, :monto_total, :monto_literal, :user_sesion, :qr, :fyh_creacion, :estado)');

$sentencia->bindParam('id_informacion',$id_informacion);
$sentencia->bindParam('nro_factura',$nro_factura);
$sentencia->bindParam('id_cliente',$id_cliente);
$sentencia->bindParam('Fecha_emision',$Fecha_emision);
$sentencia->bindParam('Fecha_ingreso',$Fecha_ingreso);
$sentencia->bindParam('Hora_ingreso',$Hora_ingreso);
$sentencia->bindParam('Fecha_salida',$Fecha_salida);
$sentencia->bindParam('Hora_salida',$Hora_salida);
$sentencia->bindParam('tiempo',$tiempo);
$sentencia->bindParam('cuviculo',$cuviculo);
$sentencia->bindParam('detalle',$detalle);
$sentencia->bindParam('precio',$precio_final);
$sentencia->bindParam('cantidad',$cantidad);
$sentencia->bindParam('total',$total);
$sentencia->bindParam('monto_total',$monto_total);
$sentencia->bindParam('monto_literal',$monto_literal);
$sentencia->bindParam('user_sesion',$user_sesion);
$sentencia->bindParam('qr',$qr);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

if($sentencia->execute()){
echo 'success';

?>
    <script>location.href = "facturacion/factura.php";</script>
<?php
}else{
echo 'error al registrar a la base de datos';
}

