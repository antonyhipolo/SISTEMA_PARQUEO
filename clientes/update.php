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
    <h2>Edicion de datos del Clientes</h2>
    
      <div class="col-md-10">
        <div class="card card-outline card-success">
              <div class="card-header">
                <h3 class="card-title">Datos del Clientes</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <!-- /.Consulta PHP para poder mostrar los datos (recuperar) -->
                <?php
                $id_cliente_get = $_GET['id'];
                $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente_get'  AND estado = '1' ");
                    $query_clientes ->execute();
                    $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
                foreach ($datos_clientes as $datos_cliente) {
                    $id_cliente = $datos_cliente['id_cliente'];
                    $nombre_cliente = $datos_cliente['nombre_cliente'];
                    $Dni_Ruc_cliente = $datos_cliente['Dni_Ruc_cliente'];
                    $Placa_auto = $datos_cliente['Placa_auto'];
                }
                ?>
              <!-- /.Finalizacion consulta -->
              <div class="card-body" style="display: block;">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nombre del Cliente <span style="color: red;"><b>*</b></span></label>
                        <input type="text"  id="nombre_cliente" class="form-control" value="<?php echo $nombre_cliente;?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">DNI / RUC <span style="color: red;"><b>*</b></span></label>
                        <input type="text" id="Dni_Ruc_cliente" class="form-control" value="<?php echo $Dni_Ruc_cliente;?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">PLACA VEHICULAR <span style="color: red;"><b>*</b></span></label>
                        <input type="text"  id="Placa_auto" class="form-control" value="<?php echo $Placa_auto;?>">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="index.php" class="btn btn-danger">CANCELAR</a>
                            <button class="btn btn-success" id="btn_actualizar_cliente">
                                ACTUALIZAR
                            </button>
                        </div>
                    </div>
                </div>
                
                <div id="respuesta">

                </div>

            </div>
</div>

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

  $('#btn_actualizar_cliente').click(function(){
    var nombre_cliente = $('#nombre_cliente').val();
    var Dni_Ruc_cliente = $('#Dni_Ruc_cliente').val();
    var Placa_auto = $('#Placa_auto').val();
    var id_cliente = "<?php echo $id_cliente_get;?>"
    if (nombre_cliente== "") {
      alert('Debe de ingresar el campo Nombre del cliente');
      $('#nombre_cliente').focus();

    }else if(Dni_Ruc_cliente == ""){
        alert('Debe de ingresar el campo DNI o RUC');
        $('#Dni_Ruc_cliente').focus();
    }else if(Placa_auto == ""){
        alert('Debe de ingresar el campo PLACA VEHICULAR');
        $('#Placa_auto').focus();
    }
    else {
      var url = 'controller_update.php'
        $.get(url, {nombre_cliente:nombre_cliente, Dni_Ruc_cliente:Dni_Ruc_cliente, Placa_auto:Placa_auto, id_cliente:id_cliente}, function(datos){
            $('#respuesta').html(datos);
        });
    }
      

  })
</script>