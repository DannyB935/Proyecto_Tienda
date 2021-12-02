<?php

    require "Funciones/checkSesion.php";

    if(isActive()==TRUE)
    {
        $name = $_SESSION['name'];
        $lastN = $_SESSION['lastN'];
        $correo = $_SESSION['emailU'];

    }

?>
<html>

    <head>

    <title> Tienda de Electronicos </title>

    <link rel="stylesheet" type="text/css" href="CSS/style.css">

    <!-- LINKS DE LA FUENTE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">

    <!-- JavaScript -->
    <script src="JS/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="JS/funciones.js"></script>

    </head>

    <body>

        <?php require "header.php";?>

        <div id="contacto">

            <form id="contact" name="formContacto" action="Funciones/correo.php" method="post">

                <h2 align="center">Contactanos!</h2>
                <div id="inputsContacto"> 

                    <label for="nombre"><b>Nombre:</b></label><br>
                    <input type="text" id="nombre" name="nombre" placeholder="Escriba su nombre"/><br>
                    <label for="last"><b>Apellido(s):</b></label><br>
                    <input type="text" id="last" name="last" placeholder="Escriba su(s) apellido(s)"/><br>
                    <label for="mail"><b>Correo:</b></label><br>
                    <input type="text" id="mail" name="mail" placeholder="Escriba su correo"/><br>
                    <label for="comentario"><b>Duda o comentario:</b></label><br>
                    <textarea id="comentario" name="comentario" cols="20" rows="3"></textarea><br>

                </div>

                <div id="errorContact" style="margin-top:5px; color:red;" align="center"></div>

                <input type="submit" id="envContacto" name="envContacto" value="Enviar" onclick="return sendContacto();"/>

            </form>

        </div>
        
        <?php require "footer.php";?>

    </body>

</html>