<?php

    require "Funciones/checkSesion.php";

    if(isActive()==TRUE)
    {
        $name = $_SESSION['name'];
        $lastN = $_SESSION['lastN'];
        $correo = $_SESSION['emailU'];

        if($_REQUEST['idPedido']==0)
        {
            header("Location: carrito01.php");
        }
    }
    else
    {
        header("Location: login.php");
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
    <script type="text/javascript" src="JS/funciones.js"></script>

    </head>

    <body>

        <?php require "header.php";?>

            <div id="tablaCarrito">

                <p align="center"> <a href="carrito01.php" style="color:black;"> Regresar </a> </p>   

                <table border="1" id="tabla" align="center" style="border-collapse:collapse; border:black;">

                    <th colspan="4"> Confrimar Pedido </th>
                    <tr>

                        <td> <b>Producto</b> </td>
                        <td> <b>Cantidad</b> </td>
                        <td> <b>Precio Unitario</b> </td>
                        <td> <b>Subtotal</b> </td>        

                    </tr>

                    <?php

                        require "Funciones/Conecta.php";

                        $connection = conecta();

                        $pedido = "SELECT * FROM pedidos WHERE status=0"; //status=0
                        $total = 0;
                        $res = $connection->query($pedido);
                        $filaPedido = $res->fetch_array();

                        if($res->num_rows==1)
                        {
                            $idPedido = $filaPedido['id'];
                            $contador = 1;

                            $productos = "SELECT nombre,id_pedido, id_producto, cantidad*precio AS subtotal, cantidad, precio FROM pedidos_productos 
                            INNER JOIN productos ON productos.id = pedidos_productos.id_producto 
                            WHERE id_pedido=$idPedido AND cantidad<>0";

                            $res = $connection->query($productos);

                            while($row = $res->fetch_array()){


                    ?>

                    <tr id="fila_<?php echo $contador; ?>">

                    <td> <?php echo $row['nombre']; ?> </td>

                    <td> <?php echo $row['cantidad']; ?> </td>

                    <td> $<?php echo $row['precio']; ?> </td>

                    <td> <b>$<?php echo $row['subtotal']; $total+=$row['subtotal']; ?> </b> </td>

                    </tr>

                    <?php 
                                $contador++; 
                            }
                        }
                    ?>

                    <tr>

                        <td> <b>Total: </b> </td>
                        <td></td>
                        <td></td>
                        <td> <b>$<?php echo $total; ?></b> </td>

                    </tr>

                </table>

                <div align="center" id="errorCarrito" style="color:red; margin:1%;">  </div>
                <div align="center" id="mensajeCarrito" style="color:#33ff33; margin:1%;">  </div>

                <div style="text-align:center;">

                    <input type="button" id="envPedido" name="envPedido" value="Confirmar Pedido" onclick="confirmPedido(<?php echo $idPedido; ?>);"/>

                </div>

            </div>
        
        <?php require "footer.php";?>

    </body>

</html>