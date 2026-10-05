<?php

include_once("conexao.php");

session_start();

$idMesa = $_GET['id'];

$sql = "UPDATE pedidos SET idStatusPedido = 2 WHERE idMesa = $idMesa";
$result = $conn->query($sql);

$sql2 = "UPDATE mesa SET idStatusMesa = 1 WHERE idMesa = $idMesa";
$result2 = $conn->query($sql2);

$_SESSION['cont'] = 1;

echo $_SESSION['cont'];

if ($result) {
    echo "<script>
    alert('Pedido finalizado!');
</script>";
header('Location: index.php');
}else{
    echo "<script>
    alert('Pedido finalizado!');
</script>";
}


?>

