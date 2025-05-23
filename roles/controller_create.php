<?php 
include('../app/config.php');
$nombre = $_GET['nombre'];


date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");
//echo $nombres . "-" . $email. "-". $contraseña;

$sentencia = $pdo->prepare("INSERT INTO tb_roles 
            (nombres, fyh_creacion, estado)
    VALUES  (:nombre, :fyh_creacion, :estado)");

$sentencia->bindParam('nombre',$nombre);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

if ($sentencia->execute()) {
    echo "Registro Satisfactorio";
    ?>
    <script>location.href = "index.php";</script>
    <?php
}else {
    echo "Error al Registrar";
}

?>