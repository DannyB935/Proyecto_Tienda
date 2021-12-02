<?php

    require "Conecta.php";
    $connection = conecta();

    $valor = $_REQUEST['suma'];
    $idPedido = $_REQUEST['idPedido'];
    $idProducto = $_REQUEST['idProducto'];
    $cantidad = $_REQUEST['cant'];

    $stock = "SELECT * FROM productos WHERE id='$idProducto'";
    $respuesta = $connection->query($stock);
    $row = $respuesta->fetch_array();
    
    $stockActual = $row['stock'];

    if($stockActual>=1)
    {

        switch($valor)
        {
            case -1:
                {
                    if($cantidad>1)
                    {
                        //Actualiza cantidad en pedidos
                        $restar = "UPDATE pedidos_productos SET cantidad=cantidad-1 WHERE id_pedido=$idPedido AND id_producto=$idProducto";
                        $res = $connection->query($restar);

                        //Actualiza stock en productos
                        $quitar = "UPDATE productos SET stock=stock+1 WHERE id='$idProducto'";
                        $res = $connection->query($quitar);
                    }
                    break;
                }
            case 1:
                {
                    //Suma el producto
                    $sumar = "UPDATE pedidos_productos SET cantidad=cantidad+1 WHERE id_pedido=$idPedido AND id_producto=$idProducto";

                    $ans = $connection->query($sumar);

                    $agregar = "UPDATE productos SET stock=stock-1 WHERE id='$idProducto'";
                    $ans = $connection->query($agregar);
                    break;
                }
        }

    }

    header("Location: ../carrito01.php");

?>