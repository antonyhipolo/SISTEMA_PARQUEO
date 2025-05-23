<?php
include('../app/config.php');
$numero_espacio = $_GET ['numero_espacio'];
$estado_espacio = $_GET ['estado_espacio'];
$obs = $_GET ['obs'];

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");
//echo $nombres . "-" . $email. "-". $contraseña;

$sentencia = $pdo->prepare("INSERT INTO tb_mapeos
            (numero_espacio, estado_espacio, obs, fyh_creacion, estado)
    VALUES  (:numero_espacio, :estado_espacio, :obs, :fyh_creacion, :estado)");

$sentencia->bindParam('numero_espacio',$numero_espacio);
$sentencia->bindParam('estado_espacio',$estado_espacio);
$sentencia->bindParam('obs',$obs);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

if ($sentencia->execute()) {
    echo "Registro Satisfactorio";
    ?>
    <script>location.href = "mapeo_de_vehiculos.php";</script>
    <?php
}else {
    echo "Error al Registrar";
}
?>