<?php
include('../app/config.php');
include('literal.php');
$id_map = $_GET['id_map'];
$id_informacion = $_GET['id_informacion'];
$nro_factura = $_GET['nro_factura'];
$id_cliente = $_GET['id_cliente'];

/// fecha de emision
date_default_timezone_set("America/Lima");
$fechaemision_fac = date("y-m-d");
$Fecha_emision = $fechaemision_fac;

date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");

//fecha de ingreso y salida
$Fecha_ingreso = $_GET['Fecha_ingreso'];
$Hora_ingreso = $_GET['Hora_ingreso'];
$Fecha_salida = date('Y-m-d');
$Hora_salida = date('H:i');

/////////////calcul
$fecha_hora_ingreso = $Fecha_ingreso." ".$Hora_ingreso;
$fecha_hora_salida = $Fecha_salida." ".$Hora_salida;
$fecha_hora_ingreso = new DateTime($fecha_hora_ingreso);
$fecha_hora_salida = new DateTime($fecha_hora_salida);
$diff = $fecha_hora_ingreso->diff($fecha_hora_salida);
$tiempo = $diff->days." días con ".$diff->h." horas con ".$diff->i." minutos";


///////////////////calculo por días////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////



$cuviculo = $_GET['cuviculo'];
$detalle = "Servicio de Parqueo de ".$tiempo;

/////////////////////////calcula el precio del cliente en horas/////////////////////
$query_precios_horas = $pdo->prepare("SELECT * FROM tb_precios WHERE cantidad = '$diff->h' AND  detalle IN ('HORA', 'HORAS') AND estado = '1' ");
        $query_precios_horas ->execute();
        $datos_precios_horas = $query_precios_horas->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datos_precios_horas as $datos_precios_hora) {
        $precios_horas = $datos_precios_hora['precio'];
        }
////////////////////////////////////////////////////////////////////////////




/////////////////////////calcula el precio del cliente en días/////////////////////
$precios_días =0;
$query_precios_días = $pdo->prepare("SELECT * FROM tb_precios WHERE cantidad = '$diff->days' AND detalle IN ('DIA', 'DIAS') AND estado = '1' ");
        $query_precios_días ->execute();
        $datos_precios_días = $query_precios_días->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datos_precios_días as $datos_precios_día) {
           $precios_días = $datos_precios_día['precio'];
        }
////////////////////////////////////////////////////////////////////////////////////

$total_minutos = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;
$menos_de_una_hora = ($total_minutos < 60);
if($menos_de_una_hora) {
    
    ?>
        <div class="alert alert-danger">
                No se puede facturar menos de 1 hora de estacionamiento
        </div>
        <script>
            $('#btn_facturar<?php echo $id_map;?>').attr('disabled','disabled');
            
        </script>
        <?php
    
}else {
        ?>
            <script>
               $('#btn_facturar<?php echo $id_map;?>').removeAttr('disabled');  
            </script>
            <?php
      

$precio_final = $precios_horas + $precios_días;


$cantidad = "1";

$total =($precio_final * $cantidad);



$monto_total = $total;

$monto_literal = numtoletras($monto_total);

$user_sesion = $_GET['user_sesion'];

///////Rescata la informacion del cliente////////
$query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente' AND estado = '1' ");
        $query_clientes ->execute();
        $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datos_clientes as $datos_cliente) {
            $id_cliente = $datos_cliente['id_cliente'];
            $nombre_cliente = $datos_cliente['nombre_cliente'];
            $Dni_Ruc_cliente = $datos_cliente['Dni_Ruc_cliente'];
            $Placa_auto = $datos_cliente['Placa_auto'];
        }

/////////////////////////////////////////
$qr = "Factura realizada por el sistema de parqueo <b>TONY_TECH S.A.C.</b>  al <b>CLIENTE:</b> ".$nombre_cliente."  con <b>DNI/ RUC:</b> ".$Dni_Ruc_cliente."
con el vehiculo de <b>PLACA:</b> ".$Placa_auto." y esta factura se genero con la <b>FECHA DE EMISION:</b> ".$Fecha_emision." a <b>HORAS:</b> ".$Hora_salida."";


$sentencia = $pdo->prepare('INSERT INTO tb_facturaciones
(id_informacion, nro_factura, id_cliente, Fecha_emision, Fecha_ingreso, Hora_ingreso, Fecha_salida, Hora_salida, tiempo, cuviculo, detalle, precio, cantidad, total, monto_total, monto_literal, user_sesion, qr, fyh_creacion, estado)
VALUES ( :id_informacion, :nro_factura, :id_cliente, :Fecha_emision, :Fecha_ingreso, :Hora_ingreso, :Fecha_salida, :Hora_salida, :tiempo, :cuviculo, :detalle, :precio, :cantidad, :total, :monto_total, :monto_literal, :user_sesion, :qr, :fyh_creacion, :estado)');

$sentencia->bindParam('id_informacion',$id_informacion);
$sentencia->bindParam('nro_factura',$nro_factura);
$sentencia->bindParam('id_cliente',$id_cliente);
$sentencia->bindParam('Fecha_emision',$Fecha_emision);
$sentencia->bindParam('Fecha_ingreso',$Fecha_ingreso);
$sentencia->bindParam('Hora_ingreso',$Hora_ingreso);
$sentencia->bindParam('Fecha_salida',$Fecha_salida);
$sentencia->bindParam('Hora_salida',$Hora_salida);
$sentencia->bindParam('tiempo',$tiempo);
$sentencia->bindParam('cuviculo',$cuviculo);
$sentencia->bindParam('detalle',$detalle);
$sentencia->bindParam('precio',$precio_final);
$sentencia->bindParam('cantidad',$cantidad);
$sentencia->bindParam('total',$total);
$sentencia->bindParam('monto_total',$monto_total);
$sentencia->bindParam('monto_literal',$monto_literal);
$sentencia->bindParam('user_sesion',$user_sesion);
$sentencia->bindParam('qr',$qr);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

if($sentencia->execute()){
echo 'success';

$estado_espacio = "LIBRE";
date_default_timezone_set("America/Lima");
$fechaHora = date("y-m-d h:i:s");
$sentencia = $pdo->prepare("UPDATE tb_mapeos SET
estado_espacio =:estado_espacio,
fyh_actualizacion = :fyh_actualizacion
WHERE numero_espacio = :numero_espacio");
$sentencia->bindParam(':estado_espacio',$estado_espacio);
$sentencia->bindParam(':fyh_actualizacion',$fechaHora);
$sentencia->bindParam(':numero_espacio',$cuviculo);
$sentencia->execute();
    

$estado_espacio_ticket = "LIBRE";

$sentencia_ticket = $pdo->prepare("UPDATE tb_tickes SET
estado_ticket = :estado_ticket WHERE Fecha_ingreso = :Fecha_ingreso AND Hora_ingreso = :Hora_ingreso");

$sentencia_ticket->bindParam(':estado_ticket',$estado_espacio_ticket);
$sentencia_ticket->bindParam(':Fecha_ingreso',$Fecha_ingreso);
$sentencia_ticket->bindParam(':Hora_ingreso',$Hora_ingreso);
$sentencia_ticket->execute();

?>
    <script>location.href = "facturacion/factura.php";</script>
<?php
}else{
echo 'error al registrar a la base de datos';
}

}