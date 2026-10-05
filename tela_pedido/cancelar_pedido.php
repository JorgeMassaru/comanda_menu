<?php

    include('conexao.php');

    session_start();

    $dados = $_SESSION['pedido'];
    $idPed = $_SESSION['idPedido'];

    $sqlDelete = "DELETE FROM pedido WHERE idPedido = $idPed";
    $result = $conn->query($sqlDelete);

    $mesa = $conn->query("UPDATE mesa SET idStatusMesa = 1 WHERE idMesa = $dados[mesa]");

    session_destroy();

    header('Location: index.php');

?>