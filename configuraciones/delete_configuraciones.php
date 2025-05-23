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
<!-- es una etiqueta HTML que crea una sección o contenedor (como una "caja") al que se le asigna una clase llamada "content-header"-->
      <div class="container-fluid"><!-- es una etiqueta HTML (usada comúnmente en frameworks como Bootstrap) que crea un contenedor que ocupa el 100% del ancho de la pantalla y se adapta fluidamente a todos los tamaños de dispositivos (móviles, tablets, PCs). -->
        <!-- /.col -->
    <div class="col-sm-8"><!-- /.col -->
          </div><!-- /.col -->
    <div class="content-wrapper">
        <br>
            <h2>Eliminación de la Informacion</h2>
        <br>
    <div class="container">
      <div class="col-md-8">
        <div class="card card-outline card-danger">
              <div class="card-header">
                <h3 class="card-title">¿Esta seguro de eliminar este Registro?</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
            
            <?php
            $id_informacion_get=$_GET['id'];
                $query_informacions= $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' AND id_informacion = '$id_informacion_get'"); // consula y seleccion de la tb_informacioons
                $query_informacions->execute(); //ejecutar
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
                    }
            ?>
              <div class="card-body" style="display: block;">
            <div class="row">
                <div class="col-md-5">
                    <label form="">Nombre del Parqueo<span style="color:red"><b></b></span></label>
                    <input type="text" class="form-control" id="nombre_parqueo" value="<?php echo $nombre_parqueo;?>" disabled>
                </div>
                 <div class="col-md-5">
                    <label form="">Actividad de la Empresa<span style="color:red"><b></b></span></label>
                    <input type="text" class="form-control" id="actividad_de_la_empresa" value="<?php echo $actividad_de_la_empresa;?>" disabled>
                </div>
                <div class="col-md-2">
                    <label form="">Sucursal<span style="color:red"><b></b></span></label>
                    <input type="text" class="form-control" id="sucursal" value="<?php echo $sucursal;?>" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label form="">Dirección<span style="color:red"><b></b></span></label>
                    <input type="text" class="form-control" id="direccion" value="<?php echo $direccion;?>" disabled>
                </div>
                <div class="col-md-6">
                    <label form="">Zona<span style="color:red"><b></b></span></label>
                    <input type="text" class="form-control" id="zona" value="<?php echo $zona;?>" disabled>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-4">
                    <label form="">Teléfono<span style="color:red"><b></b></span></label>
                    <input type="text" class="form-control" id="telefono" value="<?php echo $telefono;?>" disabled>
                </div>
                <div class="col-md-4">
                    <label form="">Departamento o Ciudad<span style="color:red"><b></b></span></label>
                    <input type="text" class="form-control" id="departamento_ciudad" value="<?php echo $departamento_ciudad;?>" disabled>
                </div>
                <div class="col-md-4">
                    <label form="">Pais<span style="color:red"><b></b></span></label>
                    <input type="text" class="form-control" id="pais" value="<?php echo $pais;?>" disabled>
                </div>
            </div>

                <hr>
                <div class="row">
                    <div class="col-md-6">
                    <a href="informacion.php" class="btn btn-default">CANCELAR</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-danger" id="btn_borrar_informacion">
                            ELIMINAR
                        </button>
                    </div>
                </div>
                <div id="respuesta">
                   
                </div>
              </div>
              <!-- /.card-body -->
            </div>
  
</div>
</div>
</div>
<?php include('../layout/admin/footer.php');?>
</>
<?php include('../layout/admin/footer_links.php');?>
</body>
</html>
<script>

  $('#btn_borrar_informacion').click(function(){

    var id_informacion = '<?php echo $id_informacion_get; ?>'
      var url = 'crontoller_delete_informacion.php'
        $.get(url, {id_informacion:id_informacion}, function(datos){
            $('#respuesta').html(datos);
        }); 
  })
</script>