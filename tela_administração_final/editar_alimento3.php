<?php

include_once("conexao.php");
session_start();

$idCat = $_SESSION['idCat'];
$idAli = $_GET['idAli'];

$sqlAlimento = "SELECT fotoAlimento FROM alimento WHERE idAlimento = $idAli";
$resultAlimento = $conn->query($sqlAlimento);
$rowAlimento = mysqli_fetch_assoc($resultAlimento);


if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $desc = $_POST['desc'];

    $foto = date("Y.m.d-H.i.s") . ".png"; //Definindo um novo nome para o arquivo
    $dir = './imgAli/'; //Diretório para uploads 
    move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $foto); //Fazer upload do arquivo
    unlink($dir . $rowAlimento['fotoAlimento']);

    $sqlAli = "UPDATE alimento SET idCatAlimento = $categoria, descAlimento = '$desc', nomeAlimento = '$nome', valorUnidade = $preco, fotoAlimento =  '$foto' WHERE idAlimento  = $idAli";
    $resultAli = $conn->query($sqlAli);

    echo "<script>
        alert('Editado com sucesso');
        window.location.href = 'cadastros.php';
    </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_editar_alimento3.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png"
        href="https://64.media.tumblr.com/d923e8a07f53a626fa8a3015fdaee3ac/79b89c18e8e1c8de-83/s1280x1920/0f79e0016d2d04ff8957b976391e625e77dc91cc.pnj" />
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


            <div class="col-4 interface2">
                <div class="row justify-content-center mb-5">
                    <div class="col">
                        <a class="" href="editar_alimento.php"><i
                                class="material-symbols-outlined voltar_icone">arrow_circle_left</i></a>
                        <div class="col col_linha_botaotexto">
                            <h1 class="texto1">Editando alimento</h1>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <?php
                    $sqlAli = "SELECT * FROM alimento WHERE idAlimento = $idAli";
                    $resultAli = $conn->query($sqlAli);
                    $rowAli = mysqli_fetch_assoc($resultAli);

                    $sqlCat2 = "SELECT * FROM categoriaalimento WHERE idCatAlimento = $idCat";
                    $resultCat2 = $conn->query($sqlCat2);
                    $rowCat2 = mysqli_fetch_assoc($resultCat2);
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="" class="texto-comida2">Escolher foto:</label>
                        <div class="personal-image">
                            <label class="label">
                                <input type="file" name="foto" />
                                <figure class="personal-figure">
                                    <img src="https://64.media.tumblr.com/9364fcebcccf962f9b0adbdecc8ee79a/8743f76c895fa20b-ff/s250x400/897200700c4e4e118196176d804fb001fcf42f3a.pnj"
                                        width="10px" heigth="10px" class="personal-avatar" alt="avatar">
                                    <figcaption class="personal-figcaption">
                                        <img
                                            src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                                    </figcaption>
                                </figure>
                            </label>
                        </div>
                </div>

                <label for="" class="texto-comida">Nome:</label>
                <input type="text" class="form-control inputs" name="nome"
                    value="<?php echo $rowAli['nomeAlimento'] ?>">
                <label for="" class="texto-comida">Preço:</label>
                <input type="number" class="form-control inputs" name="preco"
                    value="<?php echo $rowAli['valorUnidade'] ?>">

                <label for="" class="texto-comida">Categoria:</label>
                <select class="form-select inputs" name="categoria">
                    <option value="<?php echo $rowCat2['idCatAlimento'] ?>" selected><?php echo $rowCat2['nomeCatAlimento'] ?>
                    </option>
                    <?php
                    $sqlCat = "SELECT * FROM categoriaalimento";
                    $resultCat = $conn->query($sqlCat);
                    while ($row = mysqli_fetch_assoc($resultCat)) {
                        ?>
                        <option value="<?php echo $row['idCatAlimento'] ?>"><?php echo $row['nomeCatAlimento'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <label for="" class="texto-comida">Descricao:</label>
                <input type="text" class="form-control inputs-descricao" name="desc"
                    value="<?php echo $rowAli['descAlimento'] ?>">
                <input type="submit" name="submit" class="btn botao_cadastrar" value="Editar">
                </form>
                </div>

                  </div>
    </div>

</body>

</html>