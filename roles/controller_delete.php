<?php

include('../app/config.php');

$id_rol = $_GET['id_rol'];
$estado_inactivo = "0";

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");

$sentencia = $pdo->prepare("UPDATE tb_roles SET
estado = :estado,
fyh_eliminacion = :fyh_eliminacion
WHERE id_rol = :id_rol");

$sentencia->bindParam(':estado',$estado_inactivo);
$sentencia->bindParam(':fyh_eliminacion',$fechaHora);
$sentencia->bindParam(':id_rol',$id_rol);

if ($sentencia->execute()) {
    echo "Rol Eliminado";
    ?>
    <script>location.href = "../roles/";</script>
    <?php
}else {
    echo "Error al Eliminar";
}

?>