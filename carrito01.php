<?php

    require "Funciones/checkSesion.php";

    if(isActive()==TRUE)
    {
        $name = $_SESSION['name'];
        $lastN = $_SESSION['lastN'];
        $correo = $_SESSION['emailU'];

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

                <table border="1" id="tabla" align="center" style="border-collapse:collapse; border:black;">

                    <th colspan="5"> Carrito Actual </th>
                    <tr>

                        <td> <b>Producto</b> </td>
                        <td> <b>Cantidad</b> </td>
                        <td> <b>Precio Unitario</b> </td>
                        <td> <b>Subtotal</b> </td>
                        <td></td>         

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

                            $productos = "SELECT nombre,id_pedido, id_producto, cantidad*precio AS subtotal, cantidad, precio, stock FROM pedidos_productos 
                            INNER JOIN productos ON productos.id = pedidos_productos.id_producto 
                            WHERE id_pedido=$idPedido";

                            $res = $connection->query($productos);

                            while($row = $res->fetch_array()){

                    ?>

                    <tr id="fila_<?php echo $contador; ?>">

                    <td> <?php echo $row['nombre']; ?> </td>

                    <td> 
                        
                        <!-- Restar Cantidad -->
                        <input type="button" id="menos" value="-" onclick="window.location.href='Funciones/modificarCantidad.php?idProducto=<?php echo $row['id_producto'].'&idPedido='.$idPedido.'&suma=-1'.'&cant='.$row['cantidad'];?> '";/>

                        <?php echo $row['cantidad']; ?>

                        <!-- Sumar cantidad -->
                        <input type="button" id="sumar" value="+" onclick="window.location.href='Funciones/modificarCantidad.php?idProducto=<?php echo $row['id_producto'].'&idPedido='.$idPedido.'&suma=1'.'&cant='.$row['cantidad'];?> '";/> 

                    </td>

                    <td> $<?php echo $row['precio']; ?> </td>

                    <td> <b>$<?php echo $row['subtotal']; $total+=$row['subtotal']; ?> </b> </td>

                    <td>  

                        <input type="button" id="eliminarFila" value="Eliminar" onclick="deleteRow(<?php echo $row['id_producto'].','.$contador.','.$idPedido.','.$row['cantidad']?>);"/>

                    </td>

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
                        <td></td>

                    </tr>

                </table>

                <div align="center" id="errorCarrito" style="color:red; margin:1%;">  </div>
                <div align="center" id="mensajeCarrito" style="color:#33ff33; margin:1%;">  </div>

                <div style="text-align:center;">

                    <?php

                        $id  = empty($idPedido) ? 0 : $idPedido;

                    ?>
                    <input type="button" id="envPedido" name="envPedido" value="Continuar" onclick="window.location.href='carrito02.php?idPedido=<?php echo $id; ?>'"/>

                </div>

            </div>
        
        <?php require "footer.php";?>

    </body>

</html>