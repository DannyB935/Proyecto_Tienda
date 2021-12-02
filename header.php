<header id="header" class="headerFooter">

    <img id="logo" src="Imagenes/Electronic_Shop.png" style="float:left;" width="8%" height="100%"/>
    <ul id="listaHeader" class="listaHF">

        <li> <a href="index.php"> Home </a> </li>
        <li> <a href="productos.php"> Productos </a> </li>
        <li> <a href="contacto.php"> Contacto </a> </li>
        <!-- Solo cuando la sesion se inicia -->
        <?php

            if(isActive()==TRUE)
            {
                echo "<li>Bienvenido ".$name."</li>";
                echo "<li> <a href='Funciones/logOut.php'> Cerrar Sesion </a> </li>";
            }
            else{
                echo "<li> <a href='login.php'> Login </a> </li>";
                echo "<li> <a href='registro.php'> Registrarse </a> </li>";
            }

        ?>
        <li> <a href="carrito01.php"> Carrito </a> </li>

    </ul>

</header>