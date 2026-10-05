<?php
include_once("conexao.php");
session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_editar_alimento2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png"
        href="https://64.media.tumblr.com/d923e8a07f53a626fa8a3015fdaee3ac/79b89c18e8e1c8de-83/s1280x1920/0f79e0016d2d04ff8957b976391e625e77dc91cc.pnj" />

    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
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

         
            <div class="col-2 interface2">
                <?php
                $idCat = $_GET['idCat'];
                $_SESSION['idCat'] = $idCat;
                $sql3 = "SELECT * FROM categoriaalimento WHERE idCatAlimento = $idCat";
                $result3 = $conn->query($sql3);

                while ($rowCat = mysqli_fetch_assoc($result3)) {
                    $sql4 = "SELECT * FROM alimento WHERE idCatAlimento = $idCat";
                    $result4 = $conn->query($sql4);

                    ?>
                    <div class="row linha_comida">
                        <div class="col-1 coluna_linha_voltar">
                            <a class="mudar" href="editar_alimento.php"><i
                                    class="material-symbols-outlined voltar_icone">arrow_circle_left</i></a>
                        </div>
                        <div class="texto1 col-9">
                            <?php echo $rowCat['nomeCatAlimento']; ?>
                        </div>
                    </div>

                    <?php
                    while ($rowAli = mysqli_fetch_assoc($result4)) {
                        $_SESSION['preco'] = $rowAli['valorUnidade'];
                        ?>
                        <div class="row coluna_edit_alimento">
                            <div class="col-2 col_edit2_image"> <img class="imagem_edit"
                                    src="<?php echo './imgAli/' . $rowAli['fotoAlimento'] ?>" alt=""></div>
                            <div class="col-8 div_alimento_editar">
                                <span class="nome_alimento_edit">
                                    <?php echo $rowAli['nomeAlimento']; ?>
                                </span>
                                <span class="desc_alimento_edit">
                                    <?php echo $rowAli['descAlimento']; ?>
                                </span>
                                <span class="valor_alimento_edit">
                                    Valor: R$
                                    <?php echo $rowAli['valorUnidade']; ?>
                                </span>

                            </div>


                            <a class="col-2 bi bi-pencil-square icone_confirmar_editar2"
                                href="<?php echo 'editar_alimento3.php?idAli=' . $rowAli['idAlimento'] ?>"></a>
                        </div>

                        <?php
                    }
                }
                ?>

            </div>

        </div>


    </div>


    </div>

</body>

</html>