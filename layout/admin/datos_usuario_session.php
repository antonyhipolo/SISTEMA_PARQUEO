<?php

        session_start();
if(isset($_SESSION ['usuario_sesion'])){
    $usuario_session = $_SESSION['usuario_sesion'];

$query_usuario_session = $pdo->prepare("SELECT * FROM tb_usuarios WHERE email = '$usuario_session' AND estado = '1' ");
        $query_usuario_session ->execute();
        $usuarios_sessions = $query_usuario_session->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usuarios_sessions as $usuarios_session) {
          $id_user_session=$usuarios_session['id'];
          $nombres_session=$usuarios_session['nombres'];
          $email_session=$usuarios_session['email'];
          $rol_session=$usuarios_session['rol'];
        
    }
}else {
    echo "Para ingresar a esta plataforma debe iniciar sesion";
}

?>
