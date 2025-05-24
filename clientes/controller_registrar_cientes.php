<?php

include('../app/config.php');

$nombres = $_GET['nombres'];
$Dni_ruc = $_GET['Dni_ruc'];
$placa = $_GET['placa'];

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");

$sentencia = $pdo->prepare('INSERT INTO tb_clientes
(nombre_cliente, Dni_Ruc_cliente, Placa_auto, fyh_creacion, estado)
VALUES ( :nombre_cliente, :Dni_Ruc_cliente, :Placa_auto, :fyh_creacion, :estado)');

$sentencia->bindParam('nombre_cliente',$nombres);
$sentencia->bindParam('Dni_Ruc_cliente',$Dni_ruc);
$sentencia->bindParam('Placa_auto',$placa);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

if($sentencia->execute()){
echo 'success';
//header('Location:' .$URL.'/');
}else{
echo 'error al registrar a la base de datos';
}