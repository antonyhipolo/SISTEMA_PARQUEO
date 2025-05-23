<?php 
include('../app/config.php');
$nombres = $_GET['nombres'];
$email = $_GET['email'];
$contraseña = $_GET['contraseña'];

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");
//echo $nombres . "-" . $email. "-". $contraseña;

$sentencia = $pdo->prepare("INSERT INTO tb_usuarios 
            (nombres, email, password_user, fyh_creacion, estado)
    VALUES  (:nombres, :email, :password_user, :fyh_creacion, :estado)");

$sentencia->bindParam('nombres',$nombres);
$sentencia->bindParam('email',$email);
$sentencia->bindParam('password_user',$contraseña);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

if ($sentencia->execute()) {
    echo "Registro Satisfactorio";
    ?>
    <script>location.href = "../roles/asignar.php";</script>
    <?php
}else {
    echo "Error al Registrar";
}

?>