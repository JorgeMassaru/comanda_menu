<?php

require_once("conexao.php");
session_start();


if (isset($_SESSION['pedido'])) {
  $pedido = $_SESSION['pedido'];
}

if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['mesa']) && isset($_POST['categoria'])) {
  $dados = $_POST;
  print_r($dados);

  $_SESSION['pedido'] = $dados;
  $cliente = $dados['username'];

  $sqlStatus = "UPDATE mesa SET idStatusMesa = 2 where idMesa = $dados[mesa]";
  $resultMesa = $conn->query($sqlStatus);

  if (!isset($_SESSION['idPedido'])) {
    $nome = uniqid();
    

    $sql = "INSERT INTO pedido (nomePedido, nomeCliente) values ('$nome', '$cliente')";
    $result = $conn->query($sql);

    $sqlPedido = "SELECT * FROM pedido ORDER BY idPedido DESC";
    $resultPedido = $conn->query($sqlPedido);
    $rowPedido = mysqli_fetch_assoc($resultPedido);

    $_SESSION['idPedido'] = $rowPedido['idPedido'];
  }

  header('Location: proximo.php');
}
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
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
 <link rel="icon" type="image/png" href="https://64.media.tumblr.com/d923e8a07f53a626fa8a3015fdaee3ac/79b89c18e8e1c8de-83/s1280x1920/0f79e0016d2d04ff8957b976391e625e77dc91cc.pnj"/>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <title>Comanda Menu</title>
</head>

<body>
  <div class="wrapper1">
    <form class="form-signin1" method="POST">
    <?php
        if (isset($pedido)) {
        ?>
          <a class="" href="proximo.php"><span class="botao_voltar material-symbols-outlined">
arrow_circle_left
</span></a>
        <?php
        }
        ?>
      <div class="centro1">
      
        <img src="img/logo.png" class="imagem1" alt="">
        
        <h2 class="form-signin-heading1">Faça seu pedido</h2>
        <input type="text" class="form-control1 mgb1" name="username" placeholder="Nome completo" required value="<?php echo isset($pedido) ? $pedido['username'] : '' ?>" />
        <?php
        if (!isset($pedido)) {
        ?>
          <select name="mesa" class="form-control1 mgb1">
            <option value="mesa" selected disabled>Escolha uma mesa</option>
            <?php
            $sqlMesa = "SELECT * FROM mesa WHERE idStatusMesa = 1";
            $resultMesa = $conn->query($sqlMesa);
            while ($mesa = mysqli_fetch_assoc($resultMesa)) {
            ?>
              <option value="<?= $mesa['idMesa'] ?>"><?= $mesa['idMesa'] ?></option>
            <?php
            }
            ?>
          </select>
          
        <?php
        } else {
        ?>
          <select name="mesa" class="form-control1 mgb1">
            <option value="<?php echo $pedido['mesa'] ?>" selected><?php echo $pedido['mesa'] ?></option>
          </select>
          
        <?php
        }
        ?>
        <select name="categoria" class="form-control1 mgb1">
          <option value="categoria" selected disabled>Escolha uma categoria</option>
          <?php
          $sqlCat = "SELECT * FROM categoriaalimento";
          $resultCat = $conn->query($sqlCat);
          while ($cat = mysqli_fetch_assoc($resultCat)) {
          ?>
            <option value="<?= $cat['idCatAlimento'] ?>"><?= $cat['nomeCatAlimento'] ?></option>
          <?php
          }
          ?>
        </select>
        <?php
        $total = 0;
        if (!isset($pedido)) {
        ?>
          <button class="botao1 centralizar" type="submit" name="submit"><span class="material-symbols-outlined botao_prox">
next_plan
</span></button>
        <?php
        } else {
        ?>
        
  </div>
          <h2 class="form-signin-heading1"><?= 'Pedido' . $_SESSION['idPedido'] ?></h2>
          <div class="box1 row">
            <?php
            $idPed = $_SESSION['idPedido'];
            $sqlT = 'SELECT idPedido, a.nomeAlimento, count(a.nomeAlimento) as Qtd, a.valorUnidade as valor from pedidos p inner join alimento a on p.idAlimento=a.idAlimento where pedido = ' . $idPed . ' group by a.nomeAlimento';
            $resultT = $conn->query($sqlT);
            while ($t = mysqli_fetch_assoc($resultT)) {
            ?>
              <span class="comidas col-10"><?php echo "<a class='comidas2 col-2' href='remover_item.php?idItem=$t[idPedido]'><span class='material-symbols-outlined'>
delete
</span></a>" . $t['nomeAlimento'] . "<br>Qtd: " . $t['Qtd'] ?></span>
            <?php
              $total = $total + $t['valor'];
            }
            ?>
          </div>
          <p class="preco1"><?= 'R$ ' . $total ?></p>
        
        <?php
        }
        ?>
      <?php
      if(isset($pedido)){
      ?>
      <div class="row">
      <a href="cancelar_pedido.php" class="centralizar col-6"><span class="material-symbols-outlined botao_cancelar1">
cancel
</span></a>
        <button class="botao1 centralizar col-6" type="submit" name="submit"><span class="material-symbols-outlined botao_prox">
next_plan
</span></button>
        
</div>
      <?php
      }
      ?>
  </form>
  
  </div>
</body>

</html>