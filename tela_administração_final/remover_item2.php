<?php

    include_once('conexao.php');
    session_start();
    $idMesa = $_SESSION['idMesa'];

    $item = $_GET['idItem'];

    $sql = "DELETE FROM pedidos WHERE idPedido = $item";
    $result = $conn->query($sql);

    header('Location: index.php?id='.$idMesa);

?>