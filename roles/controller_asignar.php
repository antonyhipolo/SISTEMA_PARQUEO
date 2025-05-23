<?php
include('../app/config.php');
$nombre = $_POST ['nombre'];
$email = $_POST ['email'];
$id_user = $_POST ['id_user'];
$rol = $_POST ['rol'];

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");
//echo $nombres. "-" .$email. "-" .$contraseña;
$sentencia = $pdo->prepare("UPDATE tb_usuarios SET
rol =:rol
WHERE id = :id");

$sentencia->bindParam(':rol',$rol);
$sentencia->bindParam(':id',$id_user);
if ($sentencia->execute()) {
    echo "Rol Asignado";
    ?>
    <script>location.href = "../roles/asignar.php";</script>
    <?php
}else {
    echo "Error al Asignar el rol al Usuario";
}
?>