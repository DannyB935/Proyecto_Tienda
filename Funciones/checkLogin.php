<?php

    session_start();
    require "Conecta.php";
    $connection = conecta();

    $correo = $_REQUEST['mail'];
    $pass = $_REQUEST['password'];
    $pass = md5($pass);

    $user = "SELECT * FROM clientes WHERE eliminado=0 AND status=1 AND correo='$correo' AND password='$pass'";

    $res = $connection->query($user);

    if($res->num_rows==1)
    {
        $row = $res->fetch_array();

        $_SESSION['idUser'] = $row['id'];
        $_SESSION['name'] = $row['nombre'];
        $_SESSION['lastN'] = $row['apellidos'];
        $_SESSION['emailU'] = $row['correo'];
    }

    echo $res->num_rows;

?>