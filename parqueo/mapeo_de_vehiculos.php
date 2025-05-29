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


  <div class="content-wrapper">
  <br>
  <div class="container">
    <h2>LISTADO DE ESPACIOS</h2>
    </div>
    <script>
      $(document).ready( function () {
      $('#myTablemapeo').DataTable({
	         "pageLength": 5,
	         "language": {
	         "emptyTable": "No hay información",
	         "info": "Mostrando _START_ a _END_ de  _TOTAL_ Espacios",
	         "infoEmpty": "Mostrando o a o de o Espacios",
 	         "infoFiltered": "(Filtrado de _MAX_ total Espacios)",
	         "infoPostFix": "",
	         "thousands": ",",
	         "lengthMenu": "Mostrar _MENU_ Espacios",
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
     <div class="container">
      <div class="col-md-6">
    <table  id="myTablemapeo" class = "table table-bordered table-hover table-sm table-striped">
      <thead>
      <th><center>Nro</center></th>
       <th>Nro Espacio</th>
      <th><center>Accion</center></th>
      </thead>
      <tbody>
      <?php 
        $contador =0;
        $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1' ");
        $query_mapeos ->execute();
        $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);
        foreach ($mapeos as $mapeo) {
          $id_map=$mapeo['id_map'];
          $numero_espacio=$mapeo['numero_espacio'];
          $contador = $contador + 1;
          ?>
          <tr>
        <td><center><?php echo $contador;?></center></td>
        <td><?php echo $numero_espacio;?></td>
        <td>
          <center>
            <a href="delete.php?id=<?php echo $id_rol;?>" class = "btn btn-danger">Borrar</a>
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
</div>
<?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_links.php');?>
</body>
</html>