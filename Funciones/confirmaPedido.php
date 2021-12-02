<?php

    require "Conecta.php";

    $connection = conecta();

    $idPedido = $_REQUEST['idPedido'];
    $flag = 0;

    $confirma = "UPDATE pedidos SET status=1 WHERE id=$idPedido";

    $res = $connection->query($confirma);

    if($res==TRUE)
    {
        $flag=1;
    }

    echo $flag;

?>