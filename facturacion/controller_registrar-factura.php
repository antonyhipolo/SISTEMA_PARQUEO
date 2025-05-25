<?php
include('../app/config.php');

$id_informacion = $_GET['id_informacion'];
$nro_factura = $_GET['nro_factura'];
$id_cliente = $_GET['id_cliente'];

/// fecha de emision
date_default_timezone_set("America/Lima");
$fechaemision_fac = date("y-m-d");
$Fecha_emision = $fechaemision_fac;
//fecha de ingreso y salida
$Fecha_ingreso = $_GET['Fecha_ingreso'];
$Hora_ingreso = $_GET['Hora_ingreso'];
$Fecha_salida = date('d/m/y');
$Hora_salida = date('H:i');
// calcula el tiempo del parqueo
$c_hora_ingreso = strtotime($Hora_ingreso); 
$c_hora_salida = strtotime($Hora_salida);
$diferencia_de_horas = ($c_hora_salida - $c_hora_ingreso)/3600;
$hora_calculado = (int)$diferencia_de_horas;
$diferencia_minutos = ($c_hora_salida - $c_hora_ingreso)/60;
$calculando =$hora_calculado * 60;
$minutos_calculado = $diferencia_minutos-$calculando;
$tiempo = $hora_calculado." horas con ".$minutos_calculado." minutos";
////////////////////////////////////////////////////////////////////////////
$cuviculo = $_GET['cuviculo'];
$detalle = "Servicio de Parqueo de ".$tiempo;
$precio = $_GET['precio'];

/*$cantidad = $_GET['cantidad'];
$total = $_GET['total'];
$monto_total = $_GET['monto_total'];
$monto_literal = $_GET['monto_literal'];
$user_sesion = $_GET['user_sesion'];
$qr = $_GET['qr'];


$sentencia = $pdo->prepare('INSERT INTO tb_facturaciones
(id_informacion, nro_factura, id_cliente, Fecha_emision, Fecha_ingreso, Hora_ingreso, Fecha_salida, Hora_salida, tiempo, cuviculo, detalle, precio, cantidad, total, monto_total, monto_literal, user_sesion, qr, fyh_creacion, estado)
VALUES ( :id_informacion,: nro_factura,: id_cliente,: Fecha_emision,: Fecha_ingreso,: Hora_ingreso,: Fecha_salida,: Hora_salida,: tiempo,: cuviculo,: detalle,: precio,: cantidad,: total,: monto_total,: monto_literal,: user_sesion,: qr,:fyh_creacion,:estado)');

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
$sentencia->bindParam('precio',$precio);
$sentencia->bindParam('cantidad',$cantidad);
$sentencia->bindParam('total',$total);
$sentencia->bindParam('monto_total',$monto_total);
$sentencia->bindParam('monto_literal',$monto_literal);
$sentencia->bindParam('user_sesion',$user_sesion);
$sentencia->bindParam('qr',$qr);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);
*/
//if($sentencia->execute()){
//echo 'success';
//header('Location:' .$URL.'/');
//}else{
//echo 'error al registrar a la base de datos';
//}

