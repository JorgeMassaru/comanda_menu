<?php

include_once("conexao.php");



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png"
        href="https://64.media.tumblr.com/d923e8a07f53a626fa8a3015fdaee3ac/79b89c18e8e1c8de-83/s1280x1920/0f79e0016d2d04ff8957b976391e625e77dc91cc.pnj" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <title>Comanda Menu</title>
    <link rel="stylesheet" href="css/style_visualizar_pedidos.css">
</head>

<body>

    <div class="container-fluid containerPrincipal">
        <div class="row linha1">
            <div class="col coluna-nav1">
                <img class="logo" src="image/Logo_final.png" alt="">
                COMANDA MENU
            </div>
            <div class="col coluna-nav">
                <div class="botoes">
                    <?php
                    if (!isset($idMesa)) {
                        ?>
                        <a href="index.php" class="botao1">Tela Inicial</a>
                        <a href="cadastros.php" class="botao2 text-center">Cadastro / Editar</a>
                        <?php
                    } else {
                        ?>
                        <a href="index.php" class="botao1">Tela Inicial</a>
                        <span class="botao2 text-center">Cadastro / Editar</span>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>


        <div class="row linha2">
            <div class="col-4 order-first interface1">

                <div class="row justify-content-around">
                    <div class="col-md-12 col_comanda justify-content-center">
                        <div class="row justify-content-center">
                            <div class="col justify-content-center">
                                <div class="imagem_legenda">
                                    <img src="image/mesa-status.png" class="img-fluid ">
                                </div>
                            </div>
                        </div>

                        <div class="row categoriasrow">
                            <?php
                            //MOSTRA AS MESAS CADASTRADAS NO BANCO DE DADOS
                            $sql = "SELECT * FROM mesa ORDER BY idMesa";
                            $result = $conn->query($sql);
                            ////////////////////////////////////////
                            
                            //CLASSIFICA AS MESA ENTRE OCUPADAS E DISPONIVEIS
                            while ($row = mysqli_fetch_assoc($result)) {
                                $idStatusMesa = $row['idStatusMesa'];
                                $sql2 = "SELECT * FROM statusmesa WHERE idStatusMesa = $idStatusMesa";
                                $result2 = $conn->query($sql2);
                                $dados = mysqli_fetch_assoc($result2);
                                if ($idStatusMesa == 1) {

                                    ?>

                                    <!-- LISTA AS MESAS  -->
                                    <?php
                                    if (!isset($idMesa)) {
                                        ?>
                                        <div class="text-center mb-3 containernmesa">

                                            <a class="texto_categoria link"><?php echo $row['idMesa']; ?></a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="containernmesa text-center mb-3">
                                            <span class="text-white botao justify-content-center">
                                                <?php echo $row['idMesa'] ?>
                                            </span>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                } else {
                                    ?>

                                    <div class="containernmesa2 text-center mb-3">
                                        <span class="">
                                            <?php echo $row['idMesa'] ?>
                                        </span>
                                    </div>
                                    <?php

                                }
                            }
                            ?>
                        </div>
                        <!--  ------------------------------------------------------------- -->

                    </div>
                </div>



            </div>
            <div class="col-6 interface2">
                <?php
                $sql3 = "SELECT * FROM categoriaalimento";
                $result3 = $conn->query($sql3);


                ?>

                <div class="tudo_categoria">
                    <div class="row mt-4 mb-4">
                        <div class="col">
                            <div class="textoProd">Pedidos</div>
                        </div>
                    </div>
                    <?php

                    $sqlPed = "SELECT p.idPedido, p.pedido, p.idMesa, sum(a.valorUnidade) as valorPagar, s.statuspedido as status FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido where p.idStatusPedido = 1 group by p.idMesa ";
                    $resultPed = $conn->query($sqlPed);

                    while ($rowPed = mysqli_fetch_assoc($resultPed)) {
                        $num = mysqli_num_rows($resultPed);
                        $sqlNome = "SELECT nomeCliente from pedidos ps inner join pedido p on ps.pedido = p.idPedido ";
                        $nome = $conn->query($sqlNome);
                        $nomeData = mysqli_fetch_assoc($nome);

                        ?>
                        <div class="row mb-3 teste">
                            <div class="bloco1 col-11 p-3 d-flex  justify-content-between">
                                <span class="Mesa1">
                                    <?php echo $rowPed['idMesa'] ?>
                                </span>

                                <span class="Produto1">
                                    <?php echo $nomeData['nomeCliente'] ?>
                                </span>

                                <span class="Produto1">Produto:</br>
                                    <?php

                                    $idMesa2 = $rowPed['idMesa'];

                                    $sqlAux2 = "select p.pedido from pedidos p where p.idMesa = $idMesa2 and p.idStatusPedido = 1 group by p.pedido";
                                    $resultAux2 = $conn->query($sqlAux2);
                                    $rowAux2 = mysqli_fetch_assoc($resultAux2);

                                    $pedido = $rowAux2['pedido'];
                                    $sqlAux = "SELECT a.nomeAlimento FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido WHERE p.idMesa = $idMesa2 AND p.pedido = $pedido";
                                    $resultAux = $conn->query($sqlAux);

                                    while ($rowAux = mysqli_fetch_assoc($resultAux)) {
                                        echo " - " . $rowAux['nomeAlimento'];
                                    }

                                    ?>
                                </span>

                                <div class="Valor"><span>Total: </span> <span>
                                        <?php echo $rowPed['valorPagar'] ?>
                                    </span></div>
                                <span class="status">
                                    <?php echo $rowPed['status'] ?>
                                </span>
                                <?php
                                if ($rowPed['status'] != 'Pago') {
                                    ?>
                                    <span class="finalizar"><a class="final"
                                            href="<?php echo "finalizar_pedido.php?id=" . $rowPed['idMesa'] ?>">Finalizar</a></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <?php
                    }
                    ?>

                    <?php

                    $sqlPed3 = "SELECT p.idMesa FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido where p.idStatusPedido = 2 group by p.idMesa";
                    $resultPed3 = $conn->query($sqlPed3);

                    while ($rowPed3 = mysqli_fetch_assoc($resultPed3)) {

                        $idMesa3 = $rowPed3['idMesa'];

                        $sqlAux4 = "select p.pedido from pedidos p where p.idMesa = $idMesa3 and p.idStatusPedido = 2 group by p.pedido";
                        $resultAux4 = $conn->query($sqlAux4);

                        while ($rowAux4 = mysqli_fetch_assoc($resultAux4)) {

                            $sqlPed2 = "SELECT p.idPedido, p.idMesa, sum(a.valorUnidade) as valorPagar, s.statuspedido as status FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido where p.idStatusPedido = 2 group by p.pedido";
                            $resultPed2 = $conn->query($sqlPed2);

                            $rowPed2 = mysqli_fetch_assoc($resultPed2);

                            ?>
                            <div class="row mb-3">
                                <div class="bloco1 col-11 p-3 d-flex justify-content-between">
                                    <div class="blocoA">
                                        <span class="Mesa1">
                                            <?php echo $rowPed3['idMesa'] ?>
                                        </span>
                                    </div>
                                    <div class="blocoB">
                                        <span class="Produto1">Produto:<br>
                                            <?php

                                            $pedido2 = $rowAux4['pedido'];

                                            $sqlAux3 = "SELECT a.nomeAlimento FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido WHERE p.idMesa = $idMesa3 AND p.pedido = $pedido2";
                                            $resultAux3 = $conn->query($sqlAux3);

                                            while ($rowAux3 = mysqli_fetch_assoc($resultAux3)) {
                                                echo " - " . $rowAux3['nomeAlimento'];
                                            }

                                            ?>
                                        </span>
                                    </div>
                                    <span class="Valor">Total:
                                        <?php
                                        $sqlV = "SELECT sum(a.valorUnidade) as valorPagar FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido WHERE p.idMesa = $idMesa3 AND p.pedido = $pedido2";
                                        $resultV = $conn->query($sqlV);
                                        $rowV = mysqli_fetch_assoc($resultV);
                                        echo $rowV['valorPagar'];
                                        ?>
                                    </span>

                                    <span class="status">
                                        <?php echo $rowPed2['status'] ?>
                                    </span>

                                    <?php
                                    if ($rowPed2['status'] != 'Pago') {
                                        ?>
                                        <span class="final"><a
                                                href="<?php echo "finalizar_pedido.php?id=" . $rowPed2['idMesa'] ?>">Finalizar</a></span>

                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <?php
                    }

                    ?>
                </div>


            </div>
        </div>
</body>

</html>