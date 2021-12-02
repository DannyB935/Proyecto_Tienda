<?php

    require "Conecta.php";

    $connection = conecta();

    $idPedido = $_REQUEST['idPedido'];
    $idProducto = $_REQUEST['idProducto'];
    $stock = $_REQUEST['cant'];
    $flag=0;

    //Borra la fila y pone la cantidad del producto en 0
    $borrar = "UPDATE pedidos_productos SET cantidad=0 WHERE id_pedido=$idPedido AND id_producto=$idProducto";
    $res = $connection->query($borrar);

    if($res==TRUE)
    {
        $flag=1;
        //Actualiza el stock a su numero inicial
        $actualizarStock = "UPDATE productos SET stock=stock+$stock WHERE id=$idProducto";
        $res = $connection->query($actualizarStock);
    }

    echo $flag;

?>