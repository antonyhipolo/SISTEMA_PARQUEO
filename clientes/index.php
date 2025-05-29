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
    <h2></h2>
     <script>
      $(document).ready( function () {
      $('#myTableclientes').DataTable({
	         "pageLength": 5,
	         "language": {
	         "emptyTable": "No hay información",
	         "info": "Mostrando _START_ a _END_ de  _TOTAL_ Clientes",
	         "infoEmpty": "Mostrando o a o de o Clientes",
 	         "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
	         "infoPostFix": "",
	         "thousands": ",",
	         "lengthMenu": "Mostrar _MENU_ Clientes",
	         "loadingRecords": "Cargando...", 
	         "processing": "Procesando...",
	         "search": "Buscador:",
	         "zeroRecords": "Sin resultados encontrados",
	         "paginate": {
	              "first": "Primero",
	              "last": "Ultimo",
	              "next": "Siguiente",    
     }
  }
  });
});
    </script>
    <div class="row">
      <div class="col-md-10">
        <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">CLIENTES REGISTRADOS</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="display: block;">

             <table id="myTableclientes" class = "table table-bordered table-hover table-sm table-striped">
              <thead>
      <th><center>Nro</center></th>
       <th>Nombre del Cliente</th>
       <th>DNI / RUC</th>
       <th>PLACA DEL VEHICULO</th>
      <th><center>Accion</center></th>
        </thead>
        <tbody>
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
      </tbody>
    </table>
    <hr>
    <div>
    <a href="generar_reporte.php"class="btn btn-primary">Generar Reporte
      <i class="fa fa ">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-bar-graph" viewBox="0 0 16 16">
            <path d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5z"/>
            <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
        </svg>
      </i>
    </a>
</div>

              </div>
              <!-- /.card-body -->
            </div>
  

</div>
</div>
</div>
<?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_links.php');?>
</body>
</html>
