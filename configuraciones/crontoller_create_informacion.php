<?php

include('../app/config.php');

$nombre_parqueo = $_GET['nombre_parqueo'];
$actividad_de_la_empresa = $_GET['actividad_de_la_empresa'];
$sucursal = $_GET['sucursal'];
$direccion = $_GET['direccion'];
$zona = $_GET['zona'];
$telefono = $_GET['telefono'];
$departamento_ciudad = $_GET['departamento_ciudad'];
$pais = $_GET['pais'];

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");


$sentencia = $pdo->prepare('INSERT INTO tb_informaciones
(nombre_parqueo, actividad_de_la_empresa, sucursal, direccion, zona, telefono, departamento_ciudad, pais, fyh_creacion, estado)
VALUES ( :nombre_parqueo,:actividad_de_la_empresa,:sucursal,:direccion,:zona,:telefono,:departamento_ciudad,:pais,:fyh_creacion,:estado)');

$sentencia->bindParam(':nombre_parqueo',$nombre_parqueo);
$sentencia->bindParam(':actividad_de_la_empresa',$actividad_de_la_empresa);
$sentencia->bindParam(':sucursal',$sucursal);
$sentencia->bindParam(':direccion',$direccion);
$sentencia->bindParam(':zona',$zona);
$sentencia->bindParam(':telefono',$telefono);
$sentencia->bindParam(':departamento_ciudad',$departamento_ciudad);
$sentencia->bindParam(':pais',$pais);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

if($sentencia->execute()){
echo 'success';
     //header('Location:' .$URL.'/');
    ?>
    <script>location.href = "informacion.php";</script>
    <?php
}else{
echo 'error al registrar a la base de datos';
}

?>