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

            <div id="paginaProductos">    

                <?php
                    require "Funciones/Conecta.php";
                    $connection = conecta();

                    $sql = "SELECT * FROM productos WHERE eliminado=0 AND status=1 AND stock<>0";
                    $res = $connection->query($sql);

                    $prodPag = 8; //Productos que se muestran por pagina
                    $numPaginas = ceil($res->num_rows/$prodPag);
                    
                    if(empty($_REQUEST['p'])){
                        $pagina = 1;
                    }else{
                        $pagina = $_REQUEST['p'];
                    }

                    //A partir de que numero de fila
                    $inicio = (((int)$pagina-1)*$prodPag);

                    $productos = "SELECT * FROM productos WHERE eliminado=0 AND status=1 AND stock<>0 LIMIT $inicio,$prodPag";

                    $res = $connection->query($productos);
                    $contador=1;

                    while($row=$res->fetch_array()){
                ?>

                <div class="cuadroItem">

                    <a href="detalleProducto.php?id=<?php echo $row['id']; ?>&p=<?php echo $pagina?>">
                        
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

                </div><?php } ?>

            </div>

            <?php 
                
                if($pagina>1)
                {
                    echo "<a class='paginacion' href='productos.php?p=".($pagina-1)."'>Anterior</a>";
                }

                for($i=1;$i<=$numPaginas;$i++)
                {
            ?>

            <a class="paginacion" href="productos.php?p=<?php echo $i ?>"><?php echo $i; ?></a>

            <?php 

                }

                if($pagina<$numPaginas)
                {
                    echo "<a class='paginacion' href='productos.php?p=".($pagina+1)."'>Siguiente</a>";
                }

            ?>


        </div>
        
        <?php require "footer.php";?>

    </body>

</html>