<?php include('../app/config.php'); 
      include('../layout/admin/datos_usuario_session.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
<?php include('../layout/admin/head.php');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include('../layout/admin/menu.php');?>


  <div class="content-wrapper"><br>
    
  
  <div class="container">
    <h2>Creacion de Clientes</h2>
    
      <div class="col-md-10">
        <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Clientes Registrados</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="display: block;">

             <table class = "table table-bordered table-sm table-striped">
      <th><center>Nro</center></th>
       <th>Nombre del Cliente</th>
       <th>DNI / RUC</th>
       <th>PLACA DEL VEHICULO</th>
      <th><center>Accion</center></th>

      <?php 
        $contador_cliente = 0;
        $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1' ");
        $query_clientes ->execute();
        $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
        foreach ($datos_clientes as $datos_cliente) {
          $contador_cliente = $contador_cliente + 1;
            $id_cliente = $datos_cliente['id_cliente'];
            $nombre_cliente = $datos_cliente['nombre_cliente'];
            $Dni_Ruc_cliente = $datos_cliente['Dni_Ruc_cliente'];
            $Placa_auto = $datos_cliente['Placa_auto'];
          ?>
          <tr>
        <td><center><?php echo $contador_cliente;?></center></td>
        <td><?php echo $nombre_cliente;?></td>
        <td><?php echo $Dni_Ruc_cliente;?></td>
        <td><?php echo $Placa_auto;?></td>
        <td>
          <center>
            <a href="update.php?id=<?php echo $id_cliente;?>" class = "btn btn-success">Editar</a>
        </center>
        </td>
      </tr>
      <?php
        }
       
      ?>
    </table>
</div>

              </div>
              <!-- /.card-body -->
            </div>
  
</>
</div>
</div>
<?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_links.php');?>
</body>
</html>
