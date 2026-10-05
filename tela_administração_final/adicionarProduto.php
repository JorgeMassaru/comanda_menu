    <?php

    /* CRIA UM ID PARA O PEDIDO, ADCIONA OS ITENS E REALACIONA COMO O PEDIDO */

    include_once('conexao.php');
    session_start();

    $idAli = $_GET['idAli'];
    $idMesa = $_SESSION['idMesa'];
    $preco = $_SESSION['preco'];
    $idCat = $_SESSION['idCat'];


    $cont = $_SESSION['cont'];
    echo $cont;

    // $_SESSION['cont'] = 1;

    if ($cont == 1) {
        $nome = uniqid();

        $sql = "INSERT INTO pedido (nomePedido) values ('$nome')";
        $result = $conn->query($sql);

        $sqlPedido = "SELECT * FROM pedido ORDER BY idPedido DESC";
        $resultPedido = $conn->query($sqlPedido);
        $rowPedido = mysqli_fetch_assoc($resultPedido);

        $_SESSION['cont'] = 2;
        $_SESSION['pedido'] = $rowPedido['idPedido'];
    }

    $sqlPed = "SELECT * FROM pedido ORDER BY idPedido DESC";
    $resultPed = $conn->query($sqlPed);
    $row = mysqli_fetch_assoc($resultPed);
    $ped = $row['idPedido'];

    $sql2 = "INSERT INTO pedidos (idMesa, idAlimento, idStatusPedido, pedido) values ($idMesa, $idAli, 1 , $ped)";
    $result2 = $conn->query($sql2);
    if ($result2) {
        header('Location: index_categoria.php?idCat=' . $idCat);
    }


    ?>