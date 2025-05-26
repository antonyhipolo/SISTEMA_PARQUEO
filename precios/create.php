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
    <h2>Registro de Precios</h2>
    
      <div class="col-md-10">
        <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Ingrese los datos Cuidadosamente</h3>

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
                <div class="col-md-4">
                    <div class="form-group">
                        <label form="">Cantidad<span style="color: red;"><b>*</b></span></label>
                        <input type="number"  id="cantidad" class="form-control">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label form="">Detalle<span style="color: red;"><b>*</b></span></label>
                        <select name=""  id="detalle" class="form-control">
                            <option value="HORAS">HORAS</option>
                            <option value="HORA">HORA</option>
                            <option value="DIA">DIA</option>
                            <option value="DIAS">DIAS</option>
                        </select>
                    </div>
                </div>

                 <div class="col-md-4">
                    <div class="form-group">
                        <label form="">Precio<span style="color: red;"><b>*</b></span></label>
                        <input type="number" id="precio" class="form-control">
                    </div>
                </div>
              </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                    <button class="btn btn-primary" id="registar_precio">Registrar Precio</button>
                    </div>
                </div>
                <script>
                    $('#registar_precio').click(function(){
                        var cantidad = $('#cantidad').val();
                        var detalle = $('#detalle').val();
                        var precio = $('#precio').val();

                    if(cantidad =="") {
                        alert('Debe de llenar el campo Cantidad');
                        $('#cantidad').focus();
                    }else if(precio == ""){
                        alert('Debe de llenar el campo Precio');
                        $('#precio').focus();
                    }else{
                        var url = 'controller_create.php'
                        $.get(url, {cantidad:cantidad, detalle:detalle, precio:precio}, function(datos){
                        $('#respuesta').html(datos);
                            });
                    }
                    });
                </script>
                <div id="respuesta">

                </div>
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
