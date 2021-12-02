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

        <div id="content" align="center">

            <?php

                require "Funciones/Conecta.php";
                $connection = conecta();

                $banner = "SELECT * FROM banners ORDER BY RAND() LIMIT 1";
                $res = $connection->query($banner);
                $row = $res->fetch_array();

                $imgName = $row['archivo'];

            ?>

            <img src="../Proyecto_Final_A/FotosBanners/<?php echo $imgName?>" width="600px" height="200px" style="margin:5%;"/>

            <h1 align="center"> Productos del Dia </h1><br><br>

            <div id="mallaProductos">    

                <?php

                    $productos = "SELECT * FROM productos WHERE status=1 AND eliminado=0 AND stock<>0 ORDER BY RAND() LIMIT 6";
                    $res = $connection->query($productos);
                    while($row = $res->fetch_array()){

                ?>

                <div class="cuadroItem">

                    <a href="detalleProducto.php?id=<?php echo $row['id']; ?>">
                        
                        <div class="imgProducto"> 

                            <img src="../Proyecto_Final_A/FotosProd/<?php echo $row['archivo'];?>"/>

                        </div>

                    </a>
                    <div class="datosProd">

                        <?php echo $row['nombre'];?><br>
                        <?php echo "$".$row['costo'];?><br>
                        <div style="text-align:center;"> 

                            <input type="button" name="comprarB" class="botonCompra" value="Comprar" onclick="window.location.href='detalleProducto.php?id=<?php echo $row['id'];?>'"/>

                        </div>

                    </div>

                </div>

                <?php } ?>

            </div>

        </div>
        
        <?php require "footer.php";?>

    </body>

</html>