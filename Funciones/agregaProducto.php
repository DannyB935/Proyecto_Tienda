<?php

    require "checkSesion.php";
    require "Conecta.php";
    $flag = 0;

    if(isActive()==TRUE)
    {
        $name = $_SESSION['name'];
        $lastN = $_SESSION['lastN'];
        $correo = $_SESSION['emailU'];

        $connection = conecta();
        //ID producto
        $id = $_REQUEST['id'];
        $nombreCompleto = $name." ".$lastN;

        $producto = "SELECT * FROM productos WHERE status=1 AND eliminado=0 AND id=$id";

        $res = $connection->query($producto);
        $row = $res->fetch_array();

        $costoProducto = $row['costo'];

        //Pedido abierto: status=0, Pedido cerrado: status=1
        $pedido = "SELECT * FROM pedidos WHERE status=0";
        $res = $connection->query($pedido);

        //Si no hay pedido abierto
        if($res->num_rows==0)
        {
            //Crea el nuevo pedido
            $sql = "INSERT INTO pedidos (fecha,usuario) VALUES (curdate(),'$nombreCompleto')";
            $respuesta = $connection->query($sql);

            //Toma el ID del pedido abierto
            $pedidoActual = "SELECT * FROM pedidos WHERE status=0";
            $respuesta = $connection->query($pedidoActual);
            $filaPedido = $respuesta->fetch_array();
            $idPedido = $filaPedido['id'];

            //Inserta el producto en los pedidos de los productos
            $nuevoProducto = "INSERT INTO pedidos_productos (id_pedido,id_producto,cantidad,precio)
            VALUES ($idPedido,$id,1,$costoProducto)";
            $respuesta = $connection->query($nuevoProducto);

            //Actualiza el stock del producto
            $actStock = "UPDATE productos SET stock=stock-1 WHERE id=$id";
            $respuesta = $connection->query($actStock);

            $flag = 1;

        }
        else
        {
            //Si hay un pedido abierto toma el ID del pedido
            $row = $res->fetch_array();
            $idPedido = $row['id'];

            //Comprueba si el producto ya esta en la tabla de pedidos_productos
            $comprueba = "SELECT * FROM pedidos_productos WHERE id_producto=$id AND id_pedido=$idPedido";
            $respuesta = $connection->query($comprueba);

            if($respuesta->num_rows==1)
            {
                //En caso de estar ya en la tabla se actualiza su cantidad
                $actuCantidad = "UPDATE pedidos_productos SET cantidad=cantidad+1 WHERE id_producto=$id AND id_pedido=$idPedido";
                $act = $connection->query($actuCantidad);
            }
            else
            {
                //Si no lo esta, lo agrega a la tabla
                $pedidoProducto = "INSERT INTO pedidos_productos (id_pedido,id_producto,cantidad,precio)
                                VALUES ($idPedido,$id,1,$costoProducto)";
                $ans = $connection->query($pedidoProducto);
            }

            //Actualiza el stock del producto
            $actStock = "UPDATE productos SET stock=stock-1 WHERE id=$id";
            $respuesta = $connection->query($actStock);

            $flag = 1;
        }

    }
    
    echo $flag;
    
?>