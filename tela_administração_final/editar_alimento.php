<?php

include_once("conexao.php");




?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_edt_alimento1.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png"
        href="https://64.media.tumblr.com/d923e8a07f53a626fa8a3015fdaee3ac/79b89c18e8e1c8de-83/s1280x1920/0f79e0016d2d04ff8957b976391e625e77dc91cc.pnj" />

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
            <div class="col interface2">
                <div class="row justify-content-center mt-4 mb-5">
                    <div class="col">
                        <a class="" href="cadastros.php"><i
                                class="material-symbols-outlined voltar_icone">arrow_circle_left</i></a>
                        <div class="texto1">Editar alimento</div>
                    </div>
                </div>

                <div class="tudo_categoria">
                    <div class="row justify-content-center categorias">
                        <?php
                        $sql3 = "SELECT * FROM categoriaalimento";
                        $result3 = $conn->query($sql3);

                        while ($rowCat = mysqli_fetch_assoc($result3)) {
                            ?>
                            <div class="col-3 col_imag mb-4">
                                <input type="hidden" name="idCat" value="$rowCat['idCatAlimento']">

                                <a href="<?php echo 'editar_alimento2.php?idCat=' . $rowCat['idCatAlimento'] ?>"
                                    class="botao_imagem">
                                    <img src="<?php echo './imgCat/' . $rowCat['fotoCatAlimento'] ?>"
                                        class="img-fluid img_class">
                                    <p class="texto_categorias">
                                        <?php echo $rowCat['nomeCatAlimento'] ?>
                                    </p>
                                </a>



                            </div>

                            <?php
                        }


                        ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
</body>

</html>