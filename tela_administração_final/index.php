<?php
include_once("conexao.php");
session_start();


$sqlMesa = "SELECT * FROM mesa WHERE idStatusMesa = 2 ";
$resultMesa = $conn->query($sqlMesa);
while ($rowMesa = mysqli_fetch_assoc($resultMesa)) {
    $mesa = $rowMesa['idMesa'];
    $sqlVeri = "SELECT * FROM pedidos WHERE idMesa = $mesa AND idStatusPedido = 1";
    $resultVeri = $conn->query($sqlVeri);


    if (mysqli_num_rows($resultVeri) < 1) {
        $sql5 = "UPDATE mesa SET idStatusMesa = 1 WHERE idMesa = $mesa ";
        $result5 = $conn->query($sql5);
    }
}

if (isset($_GET['id'])) {
    $idMesa = $_GET['id'];
    $_SESSION['idMesa'] = $idMesa;
    $idMesa2 = $idMesa;
    $sqlStatus = "UPDATE mesa SET idStatusMesa = 2 where idMesa = $idMesa2";
    $resultMesa = $conn->query($sqlStatus);
    $idMesa2 = "";
} else {
    $_SESSION['cont'] = 1;
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="https://64.media.tumblr.com/d923e8a07f53a626fa8a3015fdaee3ac/79b89c18e8e1c8de-83/s1280x1920/0f79e0016d2d04ff8957b976391e625e77dc91cc.pnj"/>
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
                        <a href="visualizar_pedidos.php" class="botao1 text-center">Ver pedidos</a>
                        <a href="cadastros.php" class="botao2 text-center">Cadastro / Editar</a>
                        <?php
                    } else {
                        ?>
                        <span class="botao1 text-center">Ver pedidos</span>
                        <span class="botao2 text-center">Cadastro / Editar</span>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>


        <div class="row linha2">

            <div class="col-4 interface2">
                <!-- SELECIONA AS CATEGORIAS CADASTRADAS NO BANCO DE DADOS-->
                <?php
                $sql3 = "SELECT * FROM categoriaalimento";
                $result3 = $conn->query($sql3);

                /* VERIRIFICA SE ALGUMA CATEGORIA FOI SELECIONADA */
                if (!isset($_GET['id'])) {
                    ?>

                    <div class="frase1_interface2">Bem Vindo(a) a administração Comanda Menu!</div>
                    <div class="image-align imagem_hamburguer"><img src="image/food.png"
                            class="img-fluid imagem_background"></div>
                  
                    <?php
                } else {
                    ?>
                    <a href="index.php" class="bi bi-arrow-left-circle seta"></a>
                    <div class="search_div">
                        <div class="search_bar justify-content-center">
                            <button class="botao_search ">
                                <span class="bi bi-search icone"></span>
                            </button>
                            <input class="escrever" placeholder="Pesquise aqui" type="search">
                        </div>
                    </div>

                    <div class="tudo_categoria ">
                        <div class="row justify-content-center categorias">
                            <?php

                            while ($rowCat = mysqli_fetch_assoc($result3)) {
                                ?>
                                <div class="col-3 col_imag mb-3">
                                    <a href="<?php echo 'index_categoria.php?idCat=' . $rowCat['idCatAlimento'] ?>"
                                        class="botao_imagem">
                                        <img src="<?php echo './imgCat/'.$rowCat['fotoCatAlimento'] ?>" class="img-fluid img_class">
                                    </a>
                                    <p class="texto_categorias">
                                        <?php echo $rowCat['nomeCatAlimento'] ?>
                                    </p>
                                </div>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>


          
        </div>

</body>

</html>