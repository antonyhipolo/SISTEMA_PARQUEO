<?php

include('../app/config.php');

$nombres = $_GET['nombres'];
$Dni_ruc = $_GET['Dni_ruc'];
$placa = $_GET['placa'];

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");

// Busca si el cliente ya se encuetra registrado
        $contador_cliente = 0;
        $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE Placa_auto = '$placa' AND estado = '1' ");
        $query_clientes ->execute();
        $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datos_clientes as $datos_cliente) {
          $contador_cliente = $contador_cliente + 1;
        }
        if ($contador_cliente == "0") {
        echo "No hay Ningun registro igual";
            $sentencia = $pdo->prepare('INSERT INTO tb_clientes
            (nombre_cliente, Dni_Ruc_cliente, Placa_auto, fyh_creacion, estado)
            VALUES ( :nombre_cliente, :Dni_Ruc_cliente, :Placa_auto, :fyh_creacion, :estado)');

            $sentencia->bindParam('nombre_cliente',$nombres);
            $sentencia->bindParam('Dni_Ruc_cliente',$Dni_ruc);
            $sentencia->bindParam('Placa_auto',$placa);
            $sentencia->bindParam('fyh_creacion',$fechaHora);
            $sentencia->bindParam('estado',$estado_del_registro);

            if($sentencia->execute()){
            echo 'success';
                //header('Location:' .$URL.'/');
            }else{
                echo 'error al registrar a la base de datos';
            }
        }else {
        echo "Este clinete ya se encuentra registrado";
        }


