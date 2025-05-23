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
    <h2>Creacion de Informacion</h2>
    <br>
     <div class="container">
      <div class="col-md-12">
        <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Registre los datos con mucho cuidado!</h3>

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
                <div class="col-md-5">
                    <label form="">Nombre del Parqueo<span style="color:red"><b>*</b></span></label>
                    <input type="text" class="form-control" id="nombre_parqueo">
                </div>
                 <div class="col-md-5">
                    <label form="">Actividad de la Empresa<span style="color:red"><b>*</b></span></label>
                    <input type="text" class="form-control" id="actividad_de_la_empresa">
                </div>
                <div class="col-md-2">
                    <label form="">Sucursal<span style="color:red"><b>*</b></span></label>
                    <input type="text" class="form-control" id="sucursal">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label form="">Dirección<span style="color:red"><b>*</b></span></label>
                    <input type="text" class="form-control" id="direccion">
                </div>
                <div class="col-md-6">
                    <label form="">Zona<span style="color:red"><b>*</b></span></label>
                    <input type="text" class="form-control" id="zona">
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-4">
                    <label form="">Teléfono<span style="color:red"><b>*</b></span></label>
                    <input type="text" class="form-control" id="telefono">
                </div>
                <div class="col-md-4">
                    <label form="">Departamento o Ciudad<span style="color:red"><b>*</b></span></label>
                    <input type="text" class="form-control" id="departamento_ciudad">
                </div>
                <div class="col-md-4">
                    <label form="">Pais<span style="color:red"><b>*</b></span></label>
                    <input type="text" class="form-control" id="pais">
                </div>
            </div>

                <hr>
                <div class="row">
                    <div class="col-md-6">
                    <a href="informacion.php" class="btn btn-danger">CANCELAR</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary" id="btn_registrar_informacion">
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

  $('#btn_registrar_informacion').click(function(){
    var nombre_parqueo =$('#nombre_parqueo').val();
    var actividad_de_la_empresa =$('#actividad_de_la_empresa').val();
    var sucursal =$('#sucursal').val();
    var direccion =$('#direccion').val();
    var zona =$('#zona').val();
    var telefono =$('#telefono').val();
    var departamento_ciudad =$('#departamento_ciudad').val();
    var pais =$('#pais').val();
    
    if (nombre_parqueo== "") {
      alert('Debe de ingresar el campo NOMBRE DE PARQUEO');
      $('#nombre_parqueo').focus();

    }else if(actividad_de_la_empresa== ""){
        alert('Debe de ingresar el campo ACTIVIDAD DE LA EMPRESA');
        $('#actividad_de_la_empresa').focus();
    }else if(sucursal== ""){
        alert('Debe de ingresar el campo SUCURSAL');
        $('#sucursal').focus();
    }else if(direccion== ""){
        alert('Debe de ingresar el campo DIRECCION');
        $('#direccion').focus();
    }else if(zona== ""){
        alert('Debe de ingresar el campo ZONA');
        $('#zona').focus();
    }else if(telefono== ""){
        alert('Debe de ingresar el campo TELEFONO');
        $('#telefono').focus();
    }else if(departamento_ciudad== ""){
        alert('Debe de ingresar el campo DEPARTAMENTO O CIUDAD');
        $('#departamento_ciudad').focus();
    }else if(pais== ""){
        alert('Debe de ingresar el campo PAIS');
        $('#pais').focus();
    }else {
      
      var url = 'crontoller_create_informacion.php'
        $.get(url, {nombre_parqueo:nombre_parqueo, actividad_de_la_empresa:actividad_de_la_empresa, sucursal:sucursal, direccion:direccion, zona:zona, telefono:telefono, departamento_ciudad:departamento_ciudad, pais:pais}, function(datos){
            $('#respuesta').html(datos);
        });
    }
      

  })
</script>