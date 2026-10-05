<?php

    include_once('conexao.php');
    session_start();
    $idCat = $_SESSION['idCat'];

    $item = $_GET['idItem'];

    $sql = "DELETE FROM pedidos WHERE idPedido = $item";
    $result = $conn->query($sql);

    header('Location: index_categoria.php?idCat='.$idCat);

?>