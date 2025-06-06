<?php
include('app/config.php');
include('layout/admin/datos_usuario_session.php');
//recuperar el id_ informacion
$query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' "); // consula y seleccion de la tb_informacioons
        $query_informacions ->execute(); //ejecutar
        $informacions = $query_informacions->fetchAll(PDO::FETCH_ASSOC);// vaciar con el forech
        foreach ($informacions as $informacion) {
          $id_informacion=$informacion['id_informacion'];
		}
///////////////////////////////////////////////////////////////////

//recuperar el numero de la factura
$contador_del_numero_de_factura = 0;
$query_facturaciones = $pdo->prepare("SELECT * FROM tb_facturaciones WHERE estado = '1' "); // consula y seleccion de la tb_informacioons
        $query_facturaciones ->execute(); //ejecutar
        $facturaciones = $query_facturaciones->fetchAll(PDO::FETCH_ASSOC);// vaciar con el forech
        foreach ($facturaciones as $facturacione) {
            $contador_del_numero_de_factura = $contador_del_numero_de_factura+1;
		}
    $contador_del_numero_de_factura = $contador_del_numero_de_factura+1;
///////////////////////////////////////////////////////////////////


//echo "Existe session";
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
<?php include('layout/admin/head.php');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include('layout/admin/menu.php');?>
       <div class="content-wrapper">
  <br>
    <h2 style="text-align: center;">Bienvenido al Sistema de Parqueo</h2>
    <br>
     <div class="container">
      <div class="col-md-18">
        <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Mapeo Actual del Parque</h3>

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
                  <?php 
                    $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1' ");
                    $query_mapeos ->execute();
                    $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($mapeos as $mapeo) {
                      $id_map=$mapeo['id_map'];
                      $numero_espacio=$mapeo['numero_espacio'];
                      $estado_espacio=$mapeo['estado_espacio'];
                      if ($estado_espacio == "LIBRE") { ?>
                            <div class="col">
                    <center>
                      <h2><?php echo $numero_espacio;?></h2>
                      <button class="btn btn-success" style="width: 100%; height: 129px;" 
                      data-toggle="modal" data-target="#Modal<?php echo $id_map;?>">
                         <p><?php echo $estado_espacio;?></p>
                      </button>
                     <!-- Modal -->
                     <div class="modal fade" id="Modal<?php echo $id_map;?>" tabindex="-1" 
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Ingreso del Vehiculo</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                           </div>
                          <div class="modal-body">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Placa:<span><b style="color: red;">*</b></span></label>
                               <div class="col-sm-6">
                                  <input type="text" style="text-transform: uppercase" class="form-control" id="placa_buscar<?php echo $id_map;?>">
                               </div>
                               <div class="col-sm-3">
                                  <button class="btn btn-primary" id="btn_buscar_cliente<?php echo $id_map;?>" type="button">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                  </svg>  
                                      Buscar
                                  </button>
                                  <script>
                                    $('#btn_buscar_cliente<?php echo $id_map;?>').click(function() {
                                      busquedaRealizada<?php echo $id_map;?> = true
                                      var Placa = $('#placa_buscar<?php echo $id_map;?>').val();
                                      var id_map ="<?php echo $id_map;?>"
                                      if (Placa== "") {
                                        alert('Debe de ingresar el campo Placa');
                                               $('#placa_buscar<?php echo $id_map;?>').focus();
                                      }else {
                                        var url = 'clientes/controller_buscar_cliente.php'
                                           $.get(url, {Placa:Placa, id_map:id_map}, function(datos){
                                              $('#respuesta_buscar_cliente<?php echo $id_map;?>').html(datos);
                                          });
                                       }

                                    });
                                  </script>
                                  
                               </div>
                             </div>
                             <div id="respuesta_buscar_cliente<?php echo $id_map;?>">
                              </div>
                              
                              <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Fecha de Ingreso:</label>
                               <div class="col-sm-8">
                                <?php 
                                    date_default_timezone_set("America/Lima");
                                    $fechaHora = date("Y-m-d h:i:s");
                                    $dia = date ('d');
                                    $mes = date ('m');
                                    $año = date ('Y');
                                ?>
                                  <input type="date" class="form-control" id="Fecha_ingreso<?php echo $id_map;?>" value="<?php echo $año."-".$mes."-".$dia;?>">
                               </div>
                             </div>
                             <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Hora de Ingreso:</label>
                               <div class="col-sm-8">
                                <?php 
                                    date_default_timezone_set("America/Lima");
                                    $fechaHora = date("Y-m-d H:i:s");
                                    $hora = date ('H');
                                    $minutos = date ('i');
                                ?>
                                  <input type="time" class="form-control" id="Hora_ingreso<?php echo $id_map;?>" value="<?php echo $hora.":".$minutos;?>">
                               </div>
                             </div>
                             <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Cuviculo:</label>
                               <div class="col-sm-8"> 
                                <input type="text" class="form-control"  id="cuviculo<?php echo $id_map;?>" value="<?php echo $numero_espacio;?>">
                               </div>
                             </div>
                           </div>
                          <div class="modal-footer">
                            <a href="<?php echo $URL;?>/principal.php" class="btn btn-danger">Cancelar</a>
                            <button type="button" class="btn btn-primary" id="btn_registrar_ticket<?php echo $id_map;?>">Imprimir Ticheck</button>
                            <script>
                              var busquedaRealizada<?php echo $id_map;?> = false;
                              $ ('#btn_registrar_ticket<?php echo $id_map;?>').click(function(){
                              
                                var placa =$('#placa_buscar<?php echo $id_map;?>').val();
                                var nombres =$('#nombre_cliente<?php echo $id_map;?>').val();
                                var Dni_ruc =$('#Dni_ruc<?php echo $id_map;?>').val();
                                var Fecha_ingreso =$('#Fecha_ingreso<?php echo $id_map;?>').val();
                                var Hora_ingreso =$('#Hora_ingreso<?php echo $id_map;?>').val();
                                var Cuviculo =$('#cuviculo<?php echo $id_map;?>').val();
                                var user_session ="<?php echo $usuario_session;?>";
                                if (placa == "") {
                                  alert('Debe de Ingresar un Numero de Placa');
                                  $('#placa_buscar<?php echo $id_map;?>').focus();
                                }else if (!busquedaRealizada<?php echo $id_map;?>) {
                                  alert('Debe realizar la búsqueda primero antes de imprimir el ticket');
                                    $('#btn_buscar_cliente<?php echo $id_map;?>').focus();
                                }else  if(nombres == ""){
                                  alert('Debe de Ingresar un Nombre al cliente');
                                  $('#nombre_cliente<?php echo $id_map;?>').focus();
                                  return false;
                                }else if(Dni_ruc == ""){
                                  alert('Debe de Ingresar un Numero de Dni o Ruc del Cliente');
                                  $('#Dni_ruc<?php echo $id_map;?>').focus();
                                }
                                
                                else{
                                  
                                  var url_1 = 'parqueo/controller_cambiar_estado_ocupado.php'
                                      $.get(url_1, {Cuviculo:Cuviculo}, function(datos){
                                          $('#respuesta_ticket').html(datos);
                                            });
                                  
                                  

                                  var url_2 = 'clientes/controller_registrar_cientes.php'
                                      $.get(url_2, {nombres:nombres, Dni_ruc:Dni_ruc, placa:placa}, function(datos){
                                          $('#respuesta_ticket').html(datos);
                                            });


                                  var url_3 = 'tickets/controller_registrar_tickets.php'
                                      $.get(url_3, {nombres:nombres, Dni_ruc:Dni_ruc, placa:placa, Fecha_ingreso:Fecha_ingreso, Hora_ingreso:Hora_ingreso, Cuviculo:Cuviculo, user_session:user_session}, function(datos){
                                          $('#respuesta_ticket').html(datos);
                                            });
                                } 
                              });
                            </script>
                            </div>
                            <div id="respuesta_ticket">
                              
                            </div>
                        </div>
                      </div>
                     </div>
                    </center>
                  </div>
                      
                      <?php  
                      }
                      if ($estado_espacio == "OCUPADO") { ?>
                    <div class="col">
                    <center>
                      <h2><?php echo $numero_espacio;?></h2>
                      <BUtton class="btn btn-primary" id="btn_ocupado<?php echo $id_map;?>"data-toggle="modal" data-target="#exampleModal<?php echo $id_map;?>">
                        <img src="<?php  echo $URL;?>/public/imagenes/auto.png" width="60px" alt="">
                      </BUtton>
                      <?php
                      // consulta a la tabla de datos 
                    $query_datos_cliente = $pdo->prepare("SELECT * FROM tb_tickes WHERE Cuviculo = '$numero_espacio' AND estado = '1' ");
                    $query_datos_cliente ->execute();
                    $datos_clientes = $query_datos_cliente->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($datos_clientes as $datos_cliente) {
                      $id_ticket = $datos_cliente['id_ticket'];
                      $placa_auto = $datos_cliente['placa_auto'];
                      $nombres = $datos_cliente['nombres'];
                      $Dni_ruc = $datos_cliente['Dni_ruc'];
                      $Cuviculo = $datos_cliente['Cuviculo'];
                      $Fecha_ingreso = $datos_cliente['Fecha_ingreso'];
                      $Hora_ingreso = $datos_cliente['Hora_ingreso'];
                      $user_sesion = $datos_cliente['user_sesion'];
                    }
                      ?>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $id_map;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Datos del Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                               </button>
                             </div>
                             <div class="modal-body">

                               <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Placa:</label>
                               <div class="col-sm-8">
                                  <input type="text" style="text-transform: uppercase" class="form-control" value="<?php echo $placa_auto;?>" id="placa_buscar<?php echo $id_map;?>" disabled>
                               </div>
                      
                             </div>
                             <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Nombre:</label>
                                  <div class="col-sm-8">
                                      <input type="text" class="form-control"  value="<?php echo $nombres;?>" id="nombre_cliente<?php echo $id_map;?>" disabled>
                                  </div>
                                  </div>
                                  <div class="form-group row">
                                  <label for="staticEmail" class="col-sm-4 col-form-label">DNI/Ruc:</label>
                                  <div class="col-sm-8">
                                      <input type="number" class="form-control" value="<?php echo $Dni_ruc;?>" id="Dni_ruc<?php echo $id_map;?>" disabled>
                                  </div>
                                  </div>
                              
                              <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Fecha de Ingreso:</label>
                               <div class="col-sm-8">
                                
                                  <input type="text" class="form-control" value="<?php echo $Fecha_ingreso;?>" id="Fecha_ingreso<?php echo $id_map;?>" disabled>
                               </div>
                             </div>
                             <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Hora de Ingreso:</label>
                               <div class="col-sm-8">
              
                                  <input type="text" class="form-control" value="<?php echo $Hora_ingreso;?>" id="Hora_ingreso<?php echo $id_map;?>" disabled>
                               </div>
                             </div>
                             <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label">Cuviculo:</label>
                               <div class="col-sm-8"> 
                                <input type="text" class="form-control" value="<?php echo $Cuviculo;?>"  id="cuviculo<?php echo $id_map;?>" disabled>
                               </div>
                             </div>
                              </div>
                             <div class="modal-footer">
                                <a href="<?php echo $URL;?>/principal.php" class="btn btn-danger">Salir</a>
                                <a href="tickets/controller_cancelar_tickets.php?id=<?php echo $id_ticket;?>&&cuviculo=<?php echo $Cuviculo;?>" class="btn btn-warning">Cancelar Ticket</a>
                                <a href="tickets/reimprimir_ticket.php?id=<?php echo $id_ticket;?>" class="btn btn-primary">Volver a Imprimir</a>
                                
                                <button type="button" class="btn btn-success" id="btn_facturar<?php echo $id_map;?>">Facturar</button>
                                
                                  <?php
                                  //////////////Recupera el ID del cliente
                                  $query_datos_cliente_factura = $pdo->prepare("SELECT * FROM tb_clientes WHERE Placa_auto = '$placa_auto' AND estado = '1' ");
                                  $query_datos_cliente_factura ->execute();
                                    $datos_clientes_facturas = $query_datos_cliente_factura->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($datos_clientes_facturas as $datos_clientes_factura) {
                                          $id_cliente_facturacion = $datos_clientes_factura['id_cliente'];
                                        }
                                  ///////////////////////////////////////////////////////////////      

                                  ///// generar variables con los datos para enviar al controlador
                                  ?>
                                  <script>
                                  $('#btn_facturar<?php echo $id_map;?>').click(function(){
                                    var id_map = "<?php echo $id_map;?>"
                                    var id_informacion = "<?php echo $id_informacion;?>"
                                    var nro_factura = "<?php echo $contador_del_numero_de_factura;?>"
                                    var id_cliente = "<?php echo $id_cliente_facturacion;?>"
                                    var Fecha_ingreso = "<?php echo $Fecha_ingreso;?>"
                                    var Hora_ingreso = "<?php echo $Hora_ingreso;?>"
                                    var cuviculo = "<?php echo $Cuviculo;?>"
                                    var user_sesion = "<?php echo $user_sesion;?>"
                                    /// enviar al controlador
                                    var url_4 = 'facturacion/controller_registrar-factura.php'
                                      $.get(url_4, {id_map:id_map, id_informacion:id_informacion, nro_factura:nro_factura, id_cliente:id_cliente, Fecha_ingreso:Fecha_ingreso, Hora_ingreso:Hora_ingreso, cuviculo:cuviculo, user_sesion:user_sesion}, function(datos){
                                          $('#respuesta_factura<?php echo $id_map;?>').html(datos);
                                            });
                                  });
                                </script>
                             </div>
                             <div id="respuesta_factura<?php echo $id_map;?>">

                             </div>
                            </div>
                         </div>
                        </div>
                      
                      <p><?php echo $estado_espacio;?></p>
                    </center>
                  </div>
                      
                      <?php  
                      }
                      ?>
                      <?php
                    }
                  ?>
                  
                  
                  
                </div>
            

              </div>
              <!-- /.card-body -->
            </div>
  
</div>
</div>
</div>
<?php include('layout/admin/footer.php');?>
</div>
<?php include('layout/admin/footer_links.php');?>
</body>
</html>

