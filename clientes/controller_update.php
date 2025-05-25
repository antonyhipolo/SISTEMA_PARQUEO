<?php

include('../app/config.php');

$nombre_cliente = $_GET['nombre_cliente'];
$Dni_Ruc_cliente = $_GET['Dni_Ruc_cliente'];
$Placa_auto = $_GET['Placa_auto'];
$id_cliente = $_GET['id_cliente'];

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");
//echo $nombres. "-" .$email. "-" .$contraseña;

$sentencia = $pdo->prepare("UPDATE tb_clientes SET
nombre_cliente =:nombre_cliente,
Dni_Ruc_cliente = :Dni_Ruc_cliente,
Placa_auto = :Placa_auto,
fyh_actualizacion = :fyh_actualizacion
WHERE id_cliente = :id_cliente");

$sentencia->bindParam(':nombre_cliente',$nombre_cliente);
$sentencia->bindParam(':Dni_Ruc_cliente',$Dni_Ruc_cliente);
$sentencia->bindParam(':Placa_auto',$Placa_auto);
$sentencia->bindParam(':fyh_actualizacion',$fechaHora);
$sentencia->bindParam(':id_cliente',$id_cliente);
if ($sentencia->execute()) {
    echo "Cliente Modificado";
    ?>
    <script>location.href = "index.php";</script>
    <?php
}else {
    echo "Error al Modificar";
}
