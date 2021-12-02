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

        <?php

            if(empty($_REQUEST['p'])){
                $pagina=1;
            }else{
                $pagina=$_REQUEST['p'];
            }

        ?>

        <p align="center"> <a href="productos.php?p=<?php echo $pagina?>" style="color:black;"> Regresar </a> </p>

        <div id="cuadroProducto">

            <div id="producto">

                <?php

                    require "Funciones/Conecta.php";
                    $connection = conecta();                    

                    $id = $_REQUEST['id'];

                    $producto = "SELECT * FROM productos WHERE id=$id";
                    $res = $connection->query($producto);
                    $row = $res->fetch_array();

                ?>

                <img src="../Proyecto_Final_A/FotosProd/<?php echo $row['archivo'];?>"/>

            </div>
            <div id="descripcion">

                <?php

                    echo "<h2>".$row['nombre']."</h2>";
                    echo $row['descripcion']."<br><br>";
                    echo "<b>Codigo: </b>".$row['codigo']."<br>";
                    echo "<b>Stock:</b> ".$row['stock']."<br>";
                    echo "<b>Precio: $".$row['costo']."</b><br><br>";

                ?>

                <div style="text-align:center;"> 

                    <input type="button" name="comprarB" class="botonCompra" value="Agregar 1" onclick="agregarCarrito(<?php echo $row['id'];?>);"/>

                </div>

                <div id="errorProducto" style="color:red;"></div>
                <div id="mensajeProducto" style="color:#33ff33;"></div>

            </div>

        </div>
        <p style="text-align:center; font-size:large;"> <b> Productos Que Te Pueden Interesar </b> </p>
        <div id="productosExtra">

            <?php 
                $extra = "SELECT * FROM productos WHERE status=1 AND eliminado=0 AND id<>$id AND stock<>0 ORDER BY RAND() LIMIT 3";
                $res = $connection->query($extra);

                while($row=$res->fetch_array()){
            ?>

            <div class="carrusel"> 
                
                <a href="detalleProducto.php?id=<?php echo $row['id'];?>">
                    <img src="../Proyecto_Final_A/FotosProd/<?php echo $row['archivo'];?>"/>
                </a>

            </div>
            <?php } ?>

        </div>
        
        <?php require "footer.php";?>

    </body>

</html>