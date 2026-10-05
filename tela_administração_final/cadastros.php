<?php

include_once("conexao.php");

$sqlPed = "SELECT p.idMesa, a.nomeAlimento, sum(a.valorUnidade) as valorPagar, s.statuspedido as status FROM pedidos p inner join alimento a on p.idAlimento = a.idAlimento inner join statuspedido s on s.idStatusPedido = p.idStatusPedido group by p.idMesa";
$resultPed = $conn->query($sqlPed);


?>
<?php

include_once("conexao.php");

if (isset($_POST['somar'])) {
    // $status = $_POST['status'];

    $sqlMesa = "SELECT * FROM mesa";
    $resultMesa = $conn->query($sqlMesa);
    $numMesa = mysqli_num_rows($resultMesa) + 1;

    $sqlStatus = "INSERT INTO mesa (idMesa, idStatusMesa) values ($numMesa, 1)";
    $resultStatus = $conn->query($sqlStatus);

    echo "<script>
        alert('Cadastrado com sucesso');
        window.location.href = 'cadastros.php';
    </script>";
}


?>

<?php

include_once("conexao.php");

if (isset($_POST['tirar'])) {
    // $status = $_POST['status'];

    $sqlMesa = "SELECT * FROM mesa ORDER BY idMesa DESC";
    $resultMesa = $conn->query($sqlMesa);
    $rowMesa = mysqli_fetch_assoc($resultMesa);

    $sqlStatus = "DELETE FROM mesa WHERE idMesa = $rowMesa[idMesa]";
    $resultStatus = $conn->query($sqlStatus);

    echo "<script>
        alert('Mesa excluida');
        window.location.href = 'cadastros.php';
    </script>";
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_cadastros.css">
    <link rel="icon" type="image/png"
        href="https://64.media.tumblr.com/d923e8a07f53a626fa8a3015fdaee3ac/79b89c18e8e1c8de-83/s1280x1920/0f79e0016d2d04ff8957b976391e625e77dc91cc.pnj" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <title>Comanda Menu</title>
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
                        <a href="visualizar_pedidos.php" class="botao1">Visualizar Pedidos</a>
                        <a href="index.php" class="botao2 text-center">Tela Inicial</a>
                        <?php
                    } else {
                        ?>
                        <a href="Visualizar Pedidos.php" class="botao1">Visualizar Pedidos</a>
                        <span class="botao2 text-center">Cadastro / Editar</span>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>



        <div class="row linha2">

        <div class="col-4 order-first interface1">

<div class="row">
    <div class="col col_comanda">
        <div class="row centralizar">
           

                <div class="imagem_legenda">
                    <form action="" method="post" class="form_cadastro">
                        <button type="submit" name="tirar" class="botao_tirar"><span
                                class="material-symbols-outlined icone_tirar">do_not_disturb_on</span></button>
                    </form>

                    <img src="image/mesa-status.png" class="imagem_status">


                    <form action="" method="post" class="form_cadastro2">
                        <button type="submit" name="somar" class="botao_somar"><span
                                class="material-symbols-outlined icone_somar">add_circle</span></button>
                    </form>

               
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
                                        <div class="containernmesa">

                                            <a class="texto_categoria link"
                                               ><?php echo $row['idMesa']; ?></a>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="containernmesa">
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

                                    <div class="containernmesa2">
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

            <div class="col-4 interface2">
                <div class="row centralizar linha_cad">
                    <div class="col centralizar">
                        <div class="frase1_interface2 centralizar">Cadastrar</div>
                    </div>
                </div>
                <div class="row centralizar">
                    <div class="col-12 p-2 mb-4 centralizar">
                        <a href="cadastrar_comida.php" class="botaocad  p-3 px-5">&nbsp;Cadastrar alimento&nbsp;</a>
                    </div>
                    <div class="col-12 p-2 centralizar">
                        <a href="cadastrar_categoria.php" class="botaocad p-3 px-5">Cadastrar categoria</a>
                    </div>
                </div>

                <div class="row centralizar">
                    <div class="col">
                        <div class="texto1 frase2_interface2">Editar</div>
                    </div>
                </div>

                <div class="row centralizar">
                    <div class="col-12 p-2 mb-4 centralizar">
                        <a href="editar_alimento.php" class="botaoedit p-3">&nbsp;Editar alimento&nbsp;</a>
                    </div>
                    <div class="col-12 p-2 centralizar">
                        <a href="editar_categoria.php" class="botaoedit p-3">&nbsp;Editar categoria&nbsp;</a>
                    </div>
                </div>

            </div>


        </div>

</body>

</html>