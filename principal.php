<?php
include('app/config.php');
include('layout/admin/datos_usuario_session.php');


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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="btn_registrar_ticket<?php echo $id_map;?>">Imprimir Ticheck</button>
                            <script>
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
                                }else  if(nombres == ""){
                                  alert('Debe de Ingresar un Nombre al cliente');
                                  $('#nombre_cliente<?php echo $id_map;?>').focus();
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
                      <BUtton class="btn btn-primary">
                        <img src="<?php  echo $URL;?>/public/imagenes/auto.png" width="60px" alt="">
                      </BUtton>
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

