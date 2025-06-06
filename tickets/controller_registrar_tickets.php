<?php 
include('../app/config.php');

$placa = $_GET['placa'];
$placa = strtoupper($placa); //trasforma todo a mayuscula
$nombres = $_GET['nombres'];
$Dni_ruc = $_GET['Dni_ruc'];
$Cuviculo = $_GET['Cuviculo'];
$Fecha_ingreso = $_GET['Fecha_ingreso'];
$Hora_ingreso = $_GET['Hora_ingreso'];
$user_sesion = $_GET['user_session'];
$estado_ticket = "OCUPADO";

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");

$sentencia = $pdo->prepare('INSERT INTO tb_tickes
(placa_auto, nombres, Dni_ruc, Cuviculo, Fecha_ingreso, Hora_ingreso, estado_ticket, user_sesion, fyh_creacion, estado)
VALUES ( :placa_auto, :nombres, :Dni_ruc, :Cuviculo, :Fecha_ingreso, :Hora_ingreso, :estado_ticket, :user_sesion, :fyh_creacion, :estado)');

$sentencia->bindParam('placa_auto',$placa);
$sentencia->bindParam('nombres',$nombres);
$sentencia->bindParam('Dni_ruc',$Dni_ruc);
$sentencia->bindParam('Cuviculo',$Cuviculo);
$sentencia->bindParam('Fecha_ingreso',$Fecha_ingreso);
$sentencia->bindParam('Hora_ingreso',$Hora_ingreso);
$sentencia->bindParam('estado_ticket',$estado_ticket);
$sentencia->bindParam('user_sesion',$user_sesion);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

if($sentencia->execute()){
echo 'success';
    ?>
    <script>location.href = "tickets/generar_ticket.php";</script>
    <?php
}else{
echo 'error al registrar a la base de datos';
}
