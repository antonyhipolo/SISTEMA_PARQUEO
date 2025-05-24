<?php

include('../app/config.php');

$id_ticket = $_GET['id'];
$cuviculo = $_GET['cuviculo'];
$estado_inactivo = "0";

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");

$sentencia = $pdo->prepare("UPDATE tb_tickes SET
estado = :estado,
fyh_eliminacion = :fyh_eliminacion
WHERE id_ticket = :id_ticket");

$sentencia->bindParam(':estado',$estado_inactivo);
$sentencia->bindParam(':fyh_eliminacion',$fechaHora);
$sentencia->bindParam(':id_ticket',$id_ticket);

if ($sentencia->execute()) {
    
    //acctualizando el estado del cuviculo de ocupado a libre
    $estado_espacio = "LIBRE";
    $sentencia2 = $pdo->prepare("UPDATE tb_mapeos SET
    estado_espacio = :estado_espacio,
    fyh_actualizacion = :fyh_actualizacion
    WHERE numero_espacio = :numero_espacio");

    $sentencia2->bindParam(':estado_espacio',$estado_espacio);
    $sentencia2->bindParam(':fyh_actualizacion',$fechaHora);
    $sentencia2->bindParam(':numero_espacio',$cuviculo);
    if ($sentencia2->execute()) {
        echo "se actualizo el listado del  cuviculo a LIBRE";
        echo "Registro Eliminado";
    ?>
    <script>location.href = "../principal.php";</script>
    <?php
    }else{
        echo "Error al Actualizar la tabla Mapeos";
    }

   
}else {
    echo "Error al Eliminar";
}

?>