<?php
  require "php/authenticate.php";
  require "php/database_credentials.php";
  require "php/database_functions.php";

  $success = false;
  $error = false;

  if(isset($_GET["acao"]) && $_GET["acao"] == "remover"){
    
    $conn = connect_database();
    
    $id = $_GET["id"];
    $sql = "DELETE FROM $table_atividades WHERE id=" . $id;
    
    if (!mysqli_query($conn, $sql)) { 
        $error_msg = mysqli_error($conn);
        $error = true;
    } else {
      $success = true;
    }

    disconnect_database($conn);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bem-vindo à WebFit!</title>
    <link type="text/css" rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/x-icon" href="img/webfit.png">
  </head>

  <body>
      <?php require "php/menu.php"; ?>

      <div class="check-in">
        <?php if ($login): ?>
          <style>
            .checkin {
              margin-left: 42%;
              margin-right: auto;
              width: 10px;
            }
          </style>

          <?php if ($error): ?>
            <h3 style="color:red;"><?= $error_msg; ?></h3>
          <?php endif; ?>

          <?php if ($success): ?>
            <h3 style="color:lightgreen;">Treino removido com sucesso!</h3>
          <?php endif; ?>

          <h1 class= "texto">Já treinou hoje <?= ucwords(strtolower($_SESSION["user_name"])) ?>?</h1>
          <a class="checkin" href="atividades.php">
            <input id="botao" type="submit" class="fadeIn fourth" value="Fazer Check-in!">
          </a>
        <?php else: ?>
          <h1 class="texto">Bora treinar hoje?</h1>
          <a class="checkin" href="login.php">
            <input id="botao" type="submit" class="fadeIn fourth" value="Fazer Login">
          </a>
        <?php endif; ?>
      </div>


      <?php if (!$login): ?>
        <div class="atividades">
          <h1 class= "texto">Atividades disponíveis na WebFit!</h1> <hr>
          <div class="atividades">

            <?php include "php/botoes_atividades.php"; ?>

          </div>
          <?php if (isset($_GET["atividade"])): ?>
            <?php $atividade = $_GET["atividade"]; ?>
              <?php if ($atividade != "bemvindo"): ?>
                <img src="img/<?= $atividade;?>.jpg" alt="<?= ucfirst($atividade); ?>" width=100% height=100%>
              <?php else: ?>
                <?php include "php/bemvindo.php"; ?>
              <?php endif; ?>

            <?php else: ?>
              <?php include "php/bemvindo.php"; ?>
          <?php endif; ?>
        </div>
      <?php else: ?>
        <?php require "php/treino_semanal.php"; ?>
      <?php endif; ?>


  </body>
</html>
