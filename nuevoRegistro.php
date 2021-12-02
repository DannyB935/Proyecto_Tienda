<?php

    session_start();
    require "Funciones/Conecta.php";
    $connection = conecta();

    $nombre = $_REQUEST['nombre'];
    $apellidos = $_REQUEST['apellidos'];
    $correo = $_REQUEST['mail'];
    $pass = $_REQUEST['password'];
    $pass = md5($pass);

    $insert = "INSERT INTO clientes(nombre,apellidos,correo,password)
        VALUES ('$nombre','$apellidos','$correo','$pass')";

    $res = $connection->query($insert);

    $_SESSION['name'] = $nombre;
    $_SESSION['lastN'] = $apellidos;
    $_SESSION['emailU'] = $correo;

    header("Location: index.php");

?>