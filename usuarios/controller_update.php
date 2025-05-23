<?php

include('../app/config.php');
$nombres = $_GET['nombres'];
$email = $_GET['email'];
$contraseña = $_GET['contraseña'];
$id_user = $_GET['id_user'];

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");
//echo $nombres. "-" .$email. "-" .$contraseña;

$sentencia = $pdo->prepare("UPDATE tb_usuarios SET
nombres =:nombres,
email = :email,
password_user = :password_user,
fyh_actualizacion = :fyh_actualizacion
WHERE id = :id");

$sentencia->bindParam(':nombres',$nombres);
$sentencia->bindParam(':email',$email);
$sentencia->bindParam(':password_user',$contraseña);
$sentencia->bindParam(':fyh_actualizacion',$fechaHora);
$sentencia->bindParam(':id',$id_user);
if ($sentencia->execute()) {
    echo "Usuario Modificado";
    ?>
    <script>location.href = "../usuarios/";</script>
    <?php
}else {
    echo "Error al Modificar";
}
