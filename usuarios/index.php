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
<div class="container-fluid">
<div class="col-sm-8"></div>
  <div class="content-wrapper">
  <br>
    <h2>Listado de Usuarios</h2>
    <br>
  
    <script>
      $(document).ready( function () {
      $('#myTable').DataTable({
	         "pageLength": 5,
	         "language": {
	         "emptyTable": "No hay información",
	         "info": "Mostrando _START_ a _END_ de  _TOTAL_ Usuarios",
	         "infoEmpty": "Mostrando o a o de o Productos",
 	         "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
	         "infoPostFix": "",
	         "thousands": ",",
	         "lengthMenu": "Mostrar _MENU_ Usuarios",
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
    <table id="myTable"  class = "table table-bordered table-hover table-sm table-striped display nowrap">
      <thead>
      <th><center>Nro</center></th>
       <th>Nombre de Usuario</th>
      <th>Email</th>
      <th><center>Accion</center></th>
    </thead>
    <tbody>
      <?php 
        $contador =0;
        $query_usuario = $pdo->prepare("SELECT * FROM tb_usuarios WHERE estado = '1' ");
        $query_usuario ->execute();
        $usuarios = $query_usuario->fetchAll(PDO::FETCH_ASSOC);
        foreach ($usuarios as $usuario) {
          $id=$usuario['id'];
          $nombres=$usuario['nombres'];
          $email=$usuario['email'];
          $contador = $contador + 1;
          ?>
          <tr>
        <td><center><?php echo $contador;?></center></td>
        <td><?php echo $nombres;?></td>
        <td><?php echo $email;?></td>
        <td>
          <center>
            <a href="update.php?id=<?php echo $id;?>"class = "btn btn-success">Editar</a>
            <a href="delete.php?id=<?php echo $id;?>" class = "btn btn-danger">Borrar</a>
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