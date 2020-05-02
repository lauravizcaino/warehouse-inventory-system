<?php
    $hostname_localhost="localhost";
    $database_localhost="inventario";
    $username_localhost="laura";
    $password_localhost="flor.123";

    $conexion=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

    if($conexion->connect_error){
        echo "La aplicacion está experimentando problemas";
    }
    //$username="admin";
    //$password=sha1("InvLab");

    $username=$_POST['username'];
    $password=sha1($_POST['password']);

    $sentencia=$conexion->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $sentencia->bind_param('ss',$username,$password);
    $sentencia->execute();

    $resultado = $sentencia->get_result();
    if ($fila = $resultado->fetch_assoc()) {
            echo json_encode($fila,JSON_UNESCAPED_UNICODE);     
    }
    $sentencia->close();
    $conexion->close();
    
?>
