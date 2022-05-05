<?php 
  require "php/database_functions.php";
  require "php/sanitize.php";
  require "php/authenticate.php";
  require "php/validacpf.php";

  if ($login) {
    header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "./index.php"); 
    exit();
  }

  $error = false;
  $success = false;

  $name = $cpf = $endereco = $email = $confirm_email = $password = $confirm_password = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && isset($_POST["cpf"]) && isset($_POST["endereco"]) && isset($_POST["email"]) && isset($_POST["confirm_email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"]) && !empty($_POST["name"]) && !empty($_POST["cpf"]) && !empty($_POST["endereco"]) && !empty($_POST["email"]) && !empty($_POST["confirm_email"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"]) ) {
      
      $conn = connect_database();

      $name = mysqli_real_escape_string($conn, sanitize($_POST["name"]));
      $cpf = mysqli_real_escape_string($conn, sanitize($_POST["cpf"]));
      $endereco = mysqli_real_escape_string($conn, sanitize($_POST["endereco"]));
      $email = mysqli_real_escape_string($conn, sanitize($_POST["email"]));
      $confirm_email = mysqli_real_escape_string($conn, sanitize($_POST["confirm_email"]));
      $password = mysqli_real_escape_string($conn, sanitize($_POST["password"]));
      $confirm_password = mysqli_real_escape_string($conn, sanitize($_POST["confirm_password"]));
      

      if (!validaCPF($cpf)) {
        $error_msg = "CPF inválido.";
        $error = true;
      } else {
        if ($email == $confirm_email) {
          $sql = "SELECT * FROM $table_users WHERE email = '$email';";
          $result = mysqli_query($conn, $sql);
          $result = mysqli_fetch_row($result);

          if (!empty($result)) {
            $error_msg = "Esse e-mail já está cadastrado!";
            $error = true;
          } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $error_msg = "Email inválido.";
              $error = true;
            } else {
              if ($password == $confirm_password) {
                $password = md5($password);
                
                $cpf = preg_replace( '/[^0-9]/is', '', $cpf);
                date_default_timezone_set('America/Sao_Paulo');
                $timestamp = date('m/d/Y h:i:s a', time());
                
                $sql = "INSERT INTO $table_users (name, cpf, endereco, email, password, data_registro, admin) VALUES ('$name', '$cpf', '$endereco', '$email', '$password', '$timestamp', false);"; 
                
                if(mysqli_query($conn, $sql)) {
                  $success = true;
                } else { 
                  $error_msg = mysqli_error($conn);
                  $error = true;
                }
                
              } else {
                $error_msg = "As senhas inseridas não coincidem!";
                $error = true;
              }
            }
          }
  
        } else { 
          $error_msg = "Os e-mails inseridos não coincidem!";
          $error = true;
        }

      }
      
      disconnect_database($conn);

    } else {
      $error_msg = "Preencha todos os campos!";
      $error = true;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title>Cadastro</title>
      <link type="text/css" rel="stylesheet" href="css/cadastro.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="css/bootstrap.css">
      <script src="js/bootstrap.js"></script>
      <link rel="icon" type="image/x-icon" href="img/webfit.png">
      <script src="js/jquery-3.6.0.min.js"></script>
      <script src="js/validate_register_input.js"></script>
  </head>

  <body>

    <div id="formContent">
      <div class="icon">
        <a href="index.php">
          <img src="img/webfit.png" alt="Logo Webfit" width=40% height=60%>
        </a>
      </div>

      <h1>Faça já seu cadastro!</h1>
      <h2>Preencha o formulário</h2>

      <form id="cadastro" action="cadastro.php" method="post">
        <input type="text" class="text" required id="nome" name="name" placeholder="Nome Completo">
        <div id="erro-nome">

        </div>

        <input type="text" class="text" required id="cpf" name="cpf" placeholder="CPF">
        <div id="erro-cpf">

        </div>

        <input type="text" class="text" required id="endereco" name="endereco" placeholder="Endereço">
        <div id="erro-endereco">

        </div>

        <input type="email" class="text" required id="email" name="email" placeholder="Email">
        <div id="erro-email">

        </div>

        <input type="email" class="text" required id="email-confirmacao" name="confirm_email" placeholder="Confirme seu email">
        <div id="erro-confirm_email">

        </div>

        <input type="password" class= "text" required id="senha" name="password" placeholder="Senha">
        <div id="erro-password">

        </div>

        <input type="password" class= "text" required id="senha-confirmacao" name="confirm_password" placeholder="Confirme sua Senha">
        <div id="erro-confirm_password">

        </div>


        <?php if ($error): ?>
          <h5 style="color:red;"><?php echo $error_msg; ?></h5>
        <?php endif; ?>
        
        
        <?php if ($success): ?>
          <h5 style="color:lightgreen;">Usuário criado com sucesso!</h5>
          <p>
            Seguir para <a href="login.php">login</a>.
          </p>
        <?php endif; ?>
  

        <input type="submit" class="fadeIn fourth" value="Cadastrar!">

      </form>


      <div id="formFooter">
        <p>Já tem uma conta?</p>
        <a class="underlineHover" href="login.php">Entrar</a>
      </div>

    </div>
  </body>
</html>