<?php
  require "php/authenticate.php";
  require "php/database_functions.php";
  require "php/sanitize.php";
  require "php/validacpf.php";

  if (!$login) {
    header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "./index.php"); 
  }  


  $error = false;
  $success = false;

  $conn = connect_database();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && isset($_POST["cpf"]) && isset($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["cpf"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
      

      $name = mysqli_real_escape_string($conn, sanitize($_POST["name"]));
      $cpf = mysqli_real_escape_string($conn, sanitize($_POST["cpf"]));
      $email = mysqli_real_escape_string($conn, sanitize($_POST["email"]));
      $password = mysqli_real_escape_string($conn, sanitize($_POST["password"]));
      $confirm_password = mysqli_real_escape_string($conn, sanitize($_POST["confirm_password"]));


      if (!validaCPF($cpf)) {
        $error_msg = "CPF inválido.";
        $error = true;
      } else {
        $sql = "SELECT * FROM $table_users WHERE email = '$email' AND id != '$user_id';";
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
              $user_id = $_SESSION["user_id"];
              $password = md5($password);

              $sql = "SELECT password FROM Users WHERE id = '$user_id'";
              $resultado = mysqli_fetch_assoc(mysqli_query($conn, $sql));

              $encrypted_password = $resultado["password"];

              if ($password == $encrypted_password) {
                date_default_timezone_set('America/Sao_Paulo');
                $timestamp = date('m/d/Y h:i:s a', time());
                
                $cpf = preg_replace( '/[^0-9]/is', '', $cpf);

                $confirm_password = md5($confirm_password);

                $sql = "UPDATE $table_users SET name = '$name', cpf = '$cpf', email = '$email', password = '$confirm_password', last_changed = '$timestamp' WHERE id = '$user_id';"; 
                
                if(mysqli_query($conn, $sql)) {
                  $success = true;
                } else { 
                  $error_msg = mysqli_error($conn);
                  $error = true;
                }                
              } else {
                $error_msg = "Senha incorreta!";
                $error = true;
              }
            } 
          }
        }

    } else {
        $error_msg = "Preencha todos os campos!";
        $error = true;
    }
  }


  $sql = "SELECT id, name, cpf, email, data_registro FROM Users WHERE id = " . $_SESSION["user_id"];
  $result = mysqli_query($conn, $sql);
  $result = mysqli_fetch_assoc($result);

  if (isset($result)) {  
    $cpf_novo = $result["cpf"];

    $cpf_novo = substr($cpf_novo, 0, 3) . '.' . substr($cpf_novo, 3, 3) . '.' . substr($cpf_novo, 6, 3) . '-' . substr($cpf_novo, 9, 2);
  }

  disconnect_database($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Perfil</title>
    <link type="text/css" rel="stylesheet" href="css/perfil.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <link rel="icon" type="image/x-icon" href="img/webfit.png">
    <script src="js/validate_change_input.js"></script>
  </head>

  <body>
      <?php require "php/menu.php"; ?>

      <?php if(isset($result)): ?>
        <div class="perfil">
          <h1>Bem-vindo! <?= ucwords(strtolower($_SESSION["user_name"])); ?>, estes são seus dados:</h1></br>
            <form id="formulario" action="<?= $_SERVER["PHP_SELF"]; ?>" method="post">
              <input type="text" class="text" required id="nome" name="name" value="<?= ucwords(strtolower($result['name'])); ?>"></br></br>
              <div id="erro-nome">

              </div>
    
              <input type="text" class="text" required id="cpf" name="cpf" value="<?= $cpf_novo; ?>"></br></br>
              <div id="erro-cpf">

              </div>
    
              <input type="email" class="text" required id="email" name="email" value="<?= strtolower($result['email']); ?>"></br></br>
              <div id="erro-email">

              </div>
    
              <input type="password" class="text" required id="password" name="password" placeholder="Insira sua senha atual"></br></br>
              <div id="erro-password">

              </div>

              <input type="password" class="text" required id="confirm_password" name="confirm_password" placeholder="Insira a senha desejada, ou confirme sua senha"></br></br>
              <div id="erro-confirm_password">

              </div>

              <?php if ($success): ?>
                <h5 style="color:lightgreen;">Registro alterado com sucesso!</h5>
              <?php endif; ?>

              <?php if ($error): ?>
                <h5 style="color:red;"><?= $error_msg; ?></h5>
              <?php endif; ?>

              <input type="submit" class="fadeIn fourth" value="Salvar alterações">
              
            </form>
                        
        </div>
        

      <?php else:
        if ($conn) {
          echo mysqli_error($conn);
        }
      ?>
      <?php endif; ?>

  </body>
</html>
