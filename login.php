<?php
  require "php/database_functions.php";
  require "php/authenticate.php";
  require "php/sanitize.php";
 
  if ($login) {
    header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "./index.php");
    exit();
  }

  $error = false;

  $email = $password = "";

  if ((!$login) && ($_SERVER["REQUEST_METHOD"] == "POST")) {
    if (isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

      $conn = connect_database();

      $email = mysqli_real_escape_string($conn, sanitize($_POST["email"]));
      $password = mysqli_real_escape_string($conn, sanitize($_POST["password"]));

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "Email inválido.";
        $error = true;
      } else {
        $password = md5($password);

        $sql = "SELECT id, name, email, password FROM $table_users WHERE email = '$email';";
        $result = mysqli_query($conn, $sql);

        if ($result) {
          if (mysqli_num_rows($result) > 0) {
            $user_info = mysqli_fetch_assoc($result);

            if ($user_info["password"] == $password) {
              $_SESSION["user_id"] = $user_info["id"];
              $_SESSION["user_name"] = $user_info["name"];
              $_SESSION["user_email"] = $user_info["email"];

              $login = true;
              header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "./index.php");
              exit();
            } else {
              $error_msg = "Usuário ou senha incorretos!";
              $error = true;
            }
          } else {
              $error_msg = "Usuário ou senha incorretos!";
              $error = true;
          }

        } else {
          $error_msg = mysqli_error($conn);
          $error = true;
        }
      }

      disconnect_database($conn);

    } else {
        $error_msg = "Por favor preencha todos os campos!";
        $error = true;
    }
  }
?>


<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link type="text/css" rel="stylesheet" href="css/login.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="css/bootstrap.css">
      <script src="js/bootstrap.js"></script>
      <link rel="icon" type="image/x-icon" href="img/webfit.png">
      <script src="js/jquery-3.6.0.min.js"></script>
      <script src="js/validate_login_input.js"></script>
  </head>

  <body>

    <div id="formContent">
      <div class="icon">
        <a href="index.php">
          <img src="img/webfit.png" alt="Logo Webfit" width=40% height=60%>
        </a>
      </div>

      <h1>Faça seu login!</h1>

      <form id="login" action="login.php" method="post">

        <input type="email" required class="text" id="email" name="email" placeholder="email">
        <div id="erro-email">

        </div>
        
        <input type="password" required class="text" id="senha" name="password" placeholder="senha">
        <div id="erro-senha">

        </div>

        <input type="submit" class="fadeIn fourth" value="Entrar!">
      </form>


      <?php if ($error): ?>
        <h5 style="color:red;"><?= $error_msg; ?></h5>
      <?php endif; ?>

  
      <div id="formFooter">
        <p>Não tem uma conta?</p>
        <a class="underlineHover" href="cadastro.php">Cadastrar</a>
      </div>

    </div>
  </body>
</html>
