<?php

    session_start();
    require "Conecta.php";
    $connection = conecta();    

    $correo = $_REQUEST['mail'];
    $respuesta = 0;

    $check = "SELECT * FROM clientes WHERE status=1 AND eliminado=0 AND correo='$correo'";
    $res = $connection->query($check);

    if($res->num_rows>0)
    {
        $respuesta=1;
    }

    echo $respuesta;
?>