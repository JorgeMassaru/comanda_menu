<?php

include_once('conexao.php');

$nome = uniqid();

$sql = "INSERT INTO pedido (nomePedido) values ('$nome')";
$result = $conn->query($sql);


$sqlPed = "SELECT * FROM pedido ORDER BY idPedido DESC";
$resultPed = $conn->query($sqlPed);

$row = mysqli_fetch_assoc($resultPed);

echo "ID: ".$row['idPedido']."<br>Nome: ".$row['nomePedido']."<br>";

?>