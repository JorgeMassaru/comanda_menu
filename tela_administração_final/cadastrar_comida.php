<?php

include_once("conexao.php");

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $desc = $_POST['desc'];

    $foto = date("Y.m.d-H.i.s") . ".png"; //Definindo um novo nome para o arquivo
    $dir = './imgAli/'; //Diretório para uploads 
    move_uploaded_file($_FILES['foto']['tmp_name'], $dir . $foto); //Fazer upload do arquivo

    $sqlAli = "INSERT INTO alimento (idCatAlimento, descAlimento, nomeAlimento, valorUnidade, fotoAlimento) values ($categoria, '$desc', '$nome', $preco , '$foto')";
    $resultAli = $conn->query($sqlAli);

    echo "<script>
        alert('Cadastrado com sucesso');
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
    <link rel="stylesheet" href="css/style_cadastrar_comida.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
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

        <div class="row justify-content-center categoriasrow">
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
            <div class="col-4 interface2">


                <div class="row linha_comida">
                    <div class="col-1 coluna_linha_voltar">
                        <a class="mudar" href="cadastros.php"><i
                                class="material-symbols-outlined voltar_icone">arrow_circle_left</i></a>
                    </div>
                    <div class="texto1 col-9">Cadastrar alimento</div>
                </div>
                <form method="post">
                <div class="row mb-3 justify-content-center linha_tudo">
                    <div class="row linhanome_interface2 mb-3">
                        <label for="" class="texto-comida">Nome:</label>
                        <input type="text" class="form-control inputs" name="nome">
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="" class="texto-comida">Preço:</label>
                            <input type="number" class="form-control inputs" name="preco">
                        </div>
                        <div class="col-6">
                            <label for="" class="texto-comida">Categoria:</label>
                            <select class="form-select inputs" name="categoria">
                                <option value="" selected disabled>
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
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="texto-comida">Descricao:</label>
                        <textarea class="form-control inputs-descricao" name="desc"></textarea>
                    </div>
                    <input type="submit" name="submit" class="btn botao_cadastrar" value="Cadastrar">
                    </form>
                </div>

            </div>
            <div class="row footer">
        </div>

        </div>

</body>

</html>