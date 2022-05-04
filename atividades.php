<?php
  require "php/authenticate.php";
  require "php/database_functions.php";

  

  if (!$login) {
    header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "./index.php"); 
    exit();
  }

  $error = false;
  $success = false;

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["diadasemana"])) {
        setcookie("diadasemana", $_GET["diadasemana"]);
    }
    if(isset($_GET["acao"]) && $_GET["acao"] == "remover"){
        $id = $_GET["id"];
        $sql = "DELETE FROM $table_atividades WHERE id=" . $id;

        $conn = connect_database();

        if (!mysqli_query($conn, $sql)) { 
            $error_msg = mysqli_error($conn);
            $error = true;
        } 

        $success = true;
        $current = "Treino removido";

        disconnect_database($conn);
    }


  } else {     
    if (isset($_COOKIE["diadasemana"])) {
        $dia_da_semana = $_COOKIE["diadasemana"];
        $atividade = $_POST["atividade"];
        $userid = $_SESSION["user_id"];

        $conn = connect_database();

        $sql = "INSERT INTO $table_atividades (name, dia_da_semana, userid) VALUES ('$atividade', '$dia_da_semana', '$userid');";

        if (mysqli_query($conn, $sql)) {
            $success = true;
            $current = "Treino agendado";
        } else {
            $error_msg = mysqli_error($conn);
            $error = true;
        }
        
        disconnect_database($conn);
    }
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
    <div class="atividades">
        <form id="formulario_atividades" method="post" action="<?= $_SERVER["PHP_SELF"]; ?>">
        <div class="check-in">
            <h1 class="texto">Selecione o dia da semana:</h1>
            <div class="atividades">
                
                <a class="abotao" id="segunda" href="?diadasemana=segunda">
                    <input class="botao" type="button" class="fadeIn fourth" name="dia_da_semana" value="Segunda">
                </a>

                <a class="abotao" id="terca" href="?diadasemana=terca">
                    <input class="botao" type="button" class="fadeIn fourth" name="dia_da_semana" value="Terça">
                </a>

                <a class="abotao" id="quarta" href="?diadasemana=quarta">
                    <input class="botao" type="button" class="fadeIn fourth" name="dia_da_semana" value="Quarta">
                </a>
    
                <a class="abotao" id="quinta" href="?diadasemana=quinta">
                    <input class="botao" type="button" class="fadeIn fourth" name="dia_da_semana" value="Quinta">
                </a>

                <a class="abotao" id="sexta" href="?diadasemana=sexta">
                    <input class="botao" type="button" class="fadeIn fourth" name="dia_da_semana" value="Sexta">
                </a>

            </div>
    
        </div>

        <?php if ($success): ?>
          <h3 style="color:lightgreen;"><?= $current ?> com sucesso!</h3>
        <?php endif; ?>


        <?php if ($error): ?>
            <h3 style="color:red;"><?= $error_msg; ?></h3>
        <?php endif; ?>


            <div class="atividades">
                <h1 class="texto">Adicione seu treino:</h1>
                <div class="atividades">

                    <input class="botao" type="submit" class="fadeIn fourth" name="atividade" value="Spinning">

                    <input class="botao" type="submit" class="fadeIn fourth" name="atividade" value="Fit Dance">

                    <input class="botao" type="submit" class="fadeIn fourth" name="atividade" value="Pilates">

                    <input class="botao" type="submit" class="fadeIn fourth" name="atividade" value="Yoga">

                    <input class="botao" type="submit" class="fadeIn fourth" name="atividade" value="Zumba">

                    <input class="botao" type="submit" class="fadeIn fourth" name="atividade" class="musculacao" value="Musculação">
                </div>
            </div>
        </form>
    </div>


    <?php require "php/treino_semanal.php"; ?>


  </body>
</html>