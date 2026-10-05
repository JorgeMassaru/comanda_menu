<?php

    include_once('conexao.php');

    $item = $_GET['idItem'];

        $sql = "DELETE FROM pedidos WHERE idPedido = $item";
        $result = $conn->query($sql);

        header('Location: proximo.php');

?>