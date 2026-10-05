    <?php

    /* CRIA UM ID PARA O PEDIDO, ADCIONA OS ITENS E REALACIONA COMO O PEDIDO */

    include_once('conexao.php');
    session_start();


    if (isset($_POST['adicionar']) &&isset($_POST['alimento'])) {
        $dados = $_SESSION['pedido'];
        $idAli = $_POST['alimento'];
        print_r($dados);

        if (isset($_SESSION['idPedido'])) {
            $sql2 = "INSERT INTO pedidos (idMesa, idAlimento, idStatusPedido, pedido) values ($dados[mesa], $idAli, 1 , $_SESSION[idPedido])";
            $result2 = $conn->query($sql2);
            if ($result2) {
                header('Location: proximo.php');
            }
        }
    }else{
        header('Location: proximo.php');
    }

    ?>