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
   <?php
   $id_get = $_GET['id'];
    $query_usuario = $pdo->prepare("SELECT * FROM tb_usuarios WHERE  id = '$id_get' AND estado = '1' ");
        $query_usuario ->execute();
        $usuarios = $query_usuario->fetchAll(PDO::FETCH_ASSOC);
        foreach ($usuarios as $usuario) {
          $id=$usuario['id'];
          $nombres=$usuario['nombres'];
          $email=$usuario['email'];
          $password_user=$usuario['password_user'];
        }
   ?>

    <h2>Eliminacion de Usuarios</h2>
    </div>
    <div class="container">
     <div class="row">
      <div class="col-md-12">
        <div class="card card-danger" style="border: 1px solid #777777;">
              <div class="card-header">
                
                <h2 class="card-title">¿Esta seguro de eliminar este usuario?</h2>

              </div>
              <div class="card-body">
                <div class="form-group">
                  <label form="">Nombres</label>
                  <input type="text" class="form-control" id="nombres" value="<?php  echo $nombres;?>" disabled>
                </div>
                 <div class="form-group">
                  <label form="">Email</label>
                  <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" disabled>
                </div>
                <div class="form-group">
                  <label form="">Contraseña</label>
                  <input type="text" class="form-control" id="contraseña" value="<?php echo $password_user; ?>" disabled>
                </div>
                 <div class="form-group">
                  <button class="btn btn-danger" id="btn_borrar">Eliminar</button>
                  <a href="<?php echo $URL;?>/usuarios/" class="btn btn-default">Cancelar</a>
                </div>
                <div id="respuesta">
                </div>
              </div>
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
  $('#btn_borrar').click(function(){
   
    var id_user = '<?php echo $id_get = $_GET['id'];?>';
   
    var url = 'controller_delete.php'
    $.get(url, {id_user:id_user}, function(datos){
            $('#respuesta').html(datos);
        });

  });
</script>