<?php
include('../app/config.php');
$Placa = $_GET['Placa'];
$id_map = $_GET['id_map'];
$Placa = strtoupper($Placa); //trasforma todo a mayuscula
//echo "buscando la placa ".$Placa;
        $id_cliente="";
        $nombre_cliente="";
        $Dni_Ruc_cliente = "";
          

$query_buscars = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1'  AND Placa_auto ='$Placa'");
        $query_buscars ->execute();
        $buscars = $query_buscars->fetchAll(PDO::FETCH_ASSOC);
        foreach ($buscars as $buscar) {
          $id_cliente=$buscar['id_cliente'];
          $nombre_cliente=$buscar['nombre_cliente'];
          $Dni_Ruc_cliente = $buscar['Dni_Ruc_cliente'];
        }

        if ($nombre_cliente =="") {
            //echo "El cliente es nuevo";
            ?>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-3 col-form-label">Nombre:<span><b style="color: red;">*</b></span></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nombre_cliente<?php echo $id_map;?>">
            </div>
            </div>
            <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">DNI/Ruc:<span><b style="color: red;">*</b></span></label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="Dni_ruc<?php echo $id_map;?>">
            </div>
            </div>
            <?php
        }else {
            //echo $nombre_cliente. "-".$Dni_Ruc_cliente;
            ?>
            <div class="form-group row">
            <label for="staticEmail" class="col-sm-3 col-form-label">Nombre:<span><b style="color: red;">*</b></span></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nombre_cliente<?php echo $id_map;?>" value="<?php echo $nombre_cliente;?>">
             </div>
            </div>
            <div class="form-group row">
              <label for="staticEmail" class="col-sm-3 col-form-label">DNI/Ruc:<span><b style="color: red;">*</b></span></label>
             <div class="col-sm-9">
                <input type="number" class="form-control" id="Dni_ruc<?php echo $id_map;?>" value="<?php echo $Dni_Ruc_cliente;?>">
             </div>
             </div>
            <?php
        }

        // Busca la placa en la tabla tickets
        $contador_ticket = 0;
        $query_tickets = $pdo->prepare("SELECT * FROM tb_tickes WHERE placa_auto = '$Placa' AND estado_ticket = 'OCUPADO'  AND estado = '1' ");
        $query_tickets ->execute();
        $datos_tickets = $query_tickets->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datos_tickets as $datos_ticket) {
          $contador_ticket = $contador_ticket + 1;
        }
        if ($contador_ticket == "0") {
        echo "No hay Ningun registro igual";
            ?>
            <script>
               $('#btn_registrar_ticket<?php echo $id_map;?>').removeAttr('disabled');  
            </script>
            <?php
        }else {
        //echo "Este Vehiculo ya se encuentra dentro del parqueo";
        ?>
        <div class="alert alert-danger">
                Este Vehicúlo ya se encuentra dentro del parqueo
        </div>
        <script>
            $('#btn_registrar_ticket<?php echo $id_map;?>').attr('disabled','disabled');
        </script>
        <?php
        }



      ?>


