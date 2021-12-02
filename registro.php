<?php

    require "Funciones/checkSesion.php";

    if(isActive()==TRUE)
    {
        header("Location:index.php");
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
    <script src="./JS/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./JS/funciones.js"></script>

    </head>

    <body>

        <?php require "header.php";?>

        <div id="registroCuadro">

            <form id="formRegistro" name="registro" action="nuevoRegistro.php" method="post">

                <h2 align="center"> Registrate </h2>
                <div id="inputsLogin">

                    <label for="nombre"> <b>Nombre:</b> </label><br>
                    <input type="text" id="nombre" name="nombre" placeholder="Escriba su nombre"/><br>
                    <label for="nombre"> <b>Apellido(s):</b> </label><br>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Escriba su(s) apellido(s)"/><br>
                    <label for="mail"> <b>Correo:</b> </label><br>
                    <input type="text" id="mail" name="mail" placeholder="Escriba su correo"/><br>
                    <label for="password"><b>Contraseña:</b> </label><br>
                    <input type="password" id="password" name="password" placeholder="Escriba su contraseña"/>

                </div>

                <div id="mensajeRegistro" align="center"></div>

                <input type="submit" id="envRegistro" name="envRegistro" value="Registrate" onclick="return sendRegister();"/>

            </form>

        </div>
        
        <?php require "footer.php";?>

    </body>

</html>