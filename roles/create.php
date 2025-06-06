<?php 
include('../app/config.php'); 
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

  <div class="content-wrapper"> <br>
  <ol class="float-left">
  <div class="container">
    <h2>Creacion de un nuevo rol</h2>
    </div>
    <div class="container">
     <div class="row">
      <div class="col-md-12">
        <div class="card" style="border: 1px solid #60606060;">
              <div class="card-header" style = "background-color: #007bff; color:  #ffffff;">
                <h4>Nuevo Rol</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label form="">Nombre del Rol</label>
                  <input type="text" class="form-control" id="nombre">
                </div>
                 <div class="form-group">
                  <button class="btn btn-primary" id="btn_guardar">Guardar</button>
                  <a href="<?php echo $URL;?>/roles/" class="btn btn-danger">Cancelar</a>
                </div>
                <div id="respuesta">
                   
                </div>
  </div>
</div>
      </div>
      <div class="col-md-6"></div>
     </div>
    </div>
</div>
</ol>
</div>
<?php include('../layout/admin/footer.php');?>
</div>
<?php include('../layout/admin/footer_links.php');?>
</body>
</html>
 
<script>
  $('#btn_guardar').click(function(){
    var nombre = $('#nombre').val();
    
    if (nombre== "") {
      alert('Debe de ingresar el campo Nombre');
      $('#nombre').focus();

    }else {
      var url = 'controller_create.php'
        $.get(url, {nombre:nombre}, function(datos){
            $('#respuesta').html(datos);
        });
    }
      

  })
</script>