<?php

include('../app/config.php');

$Cuviculo = $_GET['Cuviculo'];
$estado_espacio = "OCUPADO";


date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");
//echo $nombres. "-" .$email. "-" .$contraseña;

$sentencia = $pdo->prepare("UPDATE tb_mapeos SET
estado_espacio =:estado_espacio,
fyh_actualizacion = :fyh_actualizacion
WHERE id_map = :id_map");

$sentencia->bindParam(':estado_espacio',$estado_espacio);
$sentencia->bindParam(':fyh_actualizacion',$fechaHora);
$sentencia->bindParam(':id_map',$Cuviculo);
if ($sentencia->execute()) {
    echo "Usuario Modificado";
    ?>
    <!--<script>location.href = "../usuarios/";</script>--¡>
    <?php
}else {
    echo "Error al Modificar";
}
