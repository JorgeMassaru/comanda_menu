<?php

require_once("conexao.php");
session_start();

$dados = $_SESSION['pedido'];
$idPed = $_SESSION['idPedido'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="icon" type="image/png" href="https://64.media.tumblr.com/d923e8a07f53a626fa8a3015fdaee3ac/79b89c18e8e1c8de-83/s1280x1920/0f79e0016d2d04ff8957b976391e625e77dc91cc.pnj" />

  <title>Comanda Menu</title>
</head>

<body>

  <div class="wrapper">

    <form class="form-signin" method="POST" action="adicionarProduto.php">
      <a href="index.php"><span class="botao_voltar material-symbols-outlined">
          arrow_circle_left
        </span></a>
      <div class="centro">

        <img src="img/logo.png" class="imagem" alt="">
        <h2 class="form-signin-heading">Escolha o alimento</h2>
        <select name="alimento" class="form-control mgb" required>
          <option value="mesa" selected disabled>Escolha um alimento</option>
          <?php
          $sqlAli = "SELECT * FROM alimento WHERE idcatAlimento = $dados[categoria]";
          $resultAli = $conn->query($sqlAli);
          while ($ali = mysqli_fetch_assoc($resultAli)) {
          ?>
            <option value="<?= $ali['idAlimento'] ?>"><?= $ali['nomeAlimento'] ?></option>
          <?php
          }
          ?>
        </select>

      </div>
      <h2 class="form-signin-heading"><?= isset($_SESSION['idPedido']) ? 'Pedido ' . $_SESSION['idPedido'] : 'Faça seu pedido' ?></h2>
      <div class="box1 row">
        <?php
        $sqlPed = "SELECT * FROM pedidos WHERE pedido = $_SESSION[idPedido]";
        $resultPed = $conn->query($sqlPed);
        $num = mysqli_num_rows($resultPed);

        $total = 0;

        if ($num < 1) {
        ?>
          <p class="centralizar">Sem itens no pedido</p>
          <?php
        } else {
          $sqlPed3 = "SELECT idPedido, nomeAlimento, count(nomeAlimento) as Qtd  from pedidos p inner join alimento a on p.idAlimento=a.idAlimento where pedido = $_SESSION[idPedido] group by a.nomeAlimento";
          $resultPed3 = $conn->query($sqlPed3);
          while ($ped = mysqli_fetch_assoc($resultPed3)) {
          ?>
            <br>
            <span class="comidas col-10"><?php echo "<a href='remover_item.php?idItem=$ped[idPedido]' class='lixo col-2'><span class='material-symbols-outlined lixo_icon'>
delete
</span></a>" . $ped['nomeAlimento'] . "<br>Qtd: " . $ped['Qtd']; ?></span>
        <?php
          }
          $sqlTotal = 'SELECT sum(a.valorUnidade) from pedidos p inner join alimento a on p.idAlimento=a.idAlimento';
          $resultTotal = $conn->query($sqlTotal);
        }
        ?>
      </div>
      <?php
      if ($num < 1) {
      ?>

        <button class="botao_somar" type="submit" name="adicionar"><span class="material-symbols-outlined icone_somar">
            add_circle
          </span></button>
      <?php
      } else {

        $sqlT = 'SELECT a.valorUnidade as valor from pedidos p inner join alimento a on p.idAlimento=a.idAlimento where pedido = ' . $idPed;
        $resultT = $conn->query($sqlT);
        while ($t = mysqli_fetch_assoc($resultT)) {
          $total = $total + $t['valor'];
        }
      ?>
        <p class="preco">R$ <?= $total ?></p>

        <div class="enviar row">
          <button class="botao botao_somar2 col-4" type="submit" name="adicionar"><span class="material-symbols-outlined icone_somar">
              add_circle
            </span>
          </button>
          <a href="cancelar_pedido.php" class="centralizar botao col-4"><span class="material-symbols-outlined botao_enviar">
              cancel
            </span></a>
          <a href="enviar_pedido.php" class="botao centralizar col-4"><span class="material-symbols-outlined botao_env">
              send
            </span></a>

        </div>
      <?php
      }
      ?>

  </div>
  </form>

</body>

</html>