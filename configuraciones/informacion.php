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

<div class="container-fluid"><!-- es una etiqueta HTML (usada comúnmente en frameworks como Bootstrap) que crea un contenedor que ocupa el 100% del ancho de la pantalla y se adapta fluidamente a todos los tamaños de dispositivos (móviles, tablets, PCs). -->
        <!-- /.col -->
    <div class="col-sm-8"></div>
  <div class="content-wrapper">
  <br>
    <h2>Listado de Informacion</h2>
    <br>
    <a href="create_informaciones.php" class="btn btn-primary">Registrar Nuevo</a><br><br>
    <table class = "table table-bordered table-sm table-striped">
      <th><center>Nro</center></th>
       <th>Nombre del Parqueo</th>
      <th><center>Actividad de la Empresa</center></th>
      <th><center>Sucursal</center></th>
      <th><center>Dirección</center></th>
      <th><center>Zona</center></th>
      <th><center>Teléfono</center></th>
      <th><center>Departamento o ciudad</center></th>
      <th><center>Pais</center></th>
      <th><center>Accion</center></th>
      
      <?php 
        $contador =0;
        $query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' "); // consula y seleccion de la tb_informacioons
        $query_informacions ->execute(); //ejecutar
        $informacions = $query_informacions->fetchAll(PDO::FETCH_ASSOC);// vaciar con el forech
        foreach ($informacions as $informacion) {
          $id_informacion=$informacion['id_informacion'];
          $nombre_parqueo=$informacion['nombre_parqueo'];
          $actividad_de_la_empresa=$informacion['actividad_de_la_empresa'];
          $sucursal=$informacion['sucursal'];
          $direccion=$informacion['direccion'];
          $zona=$informacion['zona'];
          $telefono=$informacion['telefono'];
          $departamento_ciudad=$informacion['departamento_ciudad'];
          $pais=$informacion['pais'];
          $contador = $contador + 1;

          ?>
          <tr>
        <td><center><?php echo $contador;?></center></td>
        <td><?php echo $nombre_parqueo;?></td>
        <td><center><?php echo $actividad_de_la_empresa;?></center></td>
        <td><center><?php echo $sucursal;?></center></td>
        <td><?php echo $direccion;?></td>
        <td><?php echo $zona;?></td>
        <td><center><?php echo $telefono;?></center></td>
        <td><center><?php echo $departamento_ciudad;?></center></td>
        <td><center><?php echo $pais;?></center></td>
        

        <td>
          <center>
            <a href="update_configuraciones.php?id=<?php echo $id_informacion;?>"class = "btn btn-success">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
              </svg>
            </a>
            <a href="delete_configuraciones.php?id=<?php echo $id_informacion;?>" class = "btn btn-danger">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
              </svg>
            </a>
        </center>
        </td>
      </tr>
      <?php
        }
       
      ?>
    </table>


</div>
</div>
<?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_links.php');?>
</body>
</html>