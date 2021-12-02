<?php 

    $nombre = $_REQUEST['nombre'];
    $apellidos = $_REQUEST['last'];
    $correo = $_REQUEST['mail'];
    $mensaje = $_REQUEST['comentario'];

    $respuesta = 0;

    $to = "electronicshop725@gmail.com";
    $subject = "Comentario o Duda";
    $txt = wordwrap("Correo de comentario o duda\n 
            El usuario: $nombre $apellidos \n
            Con el correo: $correo envio lo siguiente:\n\n
            $mensaje");
    $headers = "From: $correo" . "\r\n";

    $mail = mail($to,$subject,$txt,$headers);

    if($mail)
    {
        header("Location:../index.php");
    }
    else
    {
        echo 0;
    }

?>