<?php

include_once("conexao.php");

if (isset($_POST['submit'])) {
    // $status = $_POST['status'];

    $sqlMesa = "SELECT * FROM mesa";
    $resultMesa = $conn->query($sqlMesa);
    $numMesa  = mysqli_num_rows($resultMesa) + 1;

    $sqlStatus = "INSERT INTO mesa (idMesa, idStatusMesa) values ($numMesa, 1)";
    $resultStatus = $conn->query($sqlStatus);

    echo "<script>
        alert('Cadastrado com sucesso');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style_cad_mesa.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Sistema de Comanda Eletrônica</title>
</head>

<body>

    <div class="container-fluid containerPrincipal">

    <div class="row linha1 justify-content-center">
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

                            <a class="texto_categoria link" href="<?php echo 'index.php?id=' . $row['idMesa'] ?>"><?php echo $row['idMesa']; ?></a>
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
                <div class="row justify-content-center text center mt-4 mb-5">
                    <div class="col-md-8">
                        <a href="cadastros.php">Voltar</a>
                        <div class="texto1 text-dark">Cadastrar mesa</div>
                    </div>
                </div>
                <div class="row mb-3 justify-content-center ">
                    <div class="col-md-3">
                        <form action="" method="post">
                            <input type="submit" name="submit" value="Adicionar mesa" class="btn btn-primary">
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-4 order-last interface3">
                <div class="tamanho_interface3">
                    <div class="col coluna1 d-flex align-items-center ">
                        Cadastrando
                    </div>
                    <div class="col coluna2"></div>
                    <div class="col coluna4">Escolha uma edição</div>
                </div>
            </div>
        </div>

</body>

</html>