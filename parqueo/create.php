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
    <h2>Creacion de Espacios</h2>
    <br>
     <div class="container">
      <div class="col-md-6">
        <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Ingrese todos los campos</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="display: block;">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nro de Espacios</label>
                        <input type="number"  id="numero_espacio"class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                        <label for="">Estado del Espacio</label>
                        <select name="" id="estado_espacio" class="form-control">
                            <option value="LIBRE">LIBRE</option>
                        </select>
                    </div>
                </div>
            </div>

             <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Observaciones</label>
                        <textarea name="" id="obs" cols="30" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                    <a href="" class="btn btn-danger btn-block">CANCELAR</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block" id="btn_registrar">
                            REGISTRAR
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
</div>
<?php include('../layout/admin/footer_links.php');?>
</body>
</html>
<script>

  $('#btn_registrar').click(function(){
    var numero_espacio = $('#numero_espacio').val();
    var estado_espacio = $('#estado_espacio').val();
    var obs = $('#obs').val();
    if (numero_espacio== "") {
      alert('Debe de ingresar el campo Numero de espacio');
      $('#numero_espacio').focus();

    }else {
      var url = 'controller_create.php'
        $.get(url, {numero_espacio:numero_espacio, estado_espacio:estado_espacio, obs:obs}, function(datos){
            $('#respuesta').html(datos);
        });
    }
      

  })
</script>