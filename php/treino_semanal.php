
<div class="treino">
    <h1>Painel de atividades dessa semana:</h1>

    <div id="semana">

    <ul class="segunda">
        <h2>Segunda-Feira</h2>

        <?php
            $conn = connect_database();
            $user_id = $_SESSION["user_id"];
            $sql = "SELECT name, id FROM $table_atividades WHERE userid = '$user_id' and dia_da_semana = 'segunda';";

            $query_result = mysqli_query($conn, $sql);

            if (!$query_result) {
                echo mysqli_error($conn);
            } else {
                while ($value = mysqli_fetch_assoc($query_result)) { 
                    $atividade_atual = $value["name"];
                    ?>
                    <?php
                    echo "<li><h3>$atividade_atual</h3></li>";
                    ?>
                    <a class="btn-remove-tarefa" href="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $value["id"] . "&" . "acao=remover" ?>">
                        <button aria-label="Remover" class="btn btn-lg btn-danger" type="button">Remover</button>
                    </a>
                    <?php   
                }
            }

            disconnect_database($conn);    
        ?>
    </ul>


    <ul class="terca">
        <h2>Terça-Feira</h2>

        <?php
            $conn = connect_database();
            $user_id = $_SESSION["user_id"];
            $sql = "SELECT name, id FROM $table_atividades WHERE userid = '$user_id' and dia_da_semana = 'terca';";

            $query_result = mysqli_query($conn, $sql);

            if (!$query_result) {
                echo mysqli_error($conn);
            } else {
                while ($value = mysqli_fetch_assoc($query_result)) { 
                    $atividade_atual = $value["name"];
                    ?>
                    <?php
                    echo "<li><h3>$atividade_atual</h3></li>";
                    ?>
                    <a class="btn-remove-tarefa" href="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $value["id"] . "&" . "acao=remover" ?>">
                        <button aria-label="Remover" class="btn btn-lg btn-danger" type="button">Remover</button>
                    </a>
                    <?php
                }
            }
            disconnect_database($conn);            
        ?>
    </ul>

    <ul class="quarta">
        <h2>Quarta-Feira</h2>

        <?php
            $conn = connect_database();
            $user_id = $_SESSION["user_id"];
            $sql = "SELECT name, id FROM $table_atividades WHERE userid = '$user_id' and dia_da_semana = 'quarta';";

            $query_result = mysqli_query($conn, $sql);

            if (!$query_result) {
                echo mysqli_error($conn);
            } else {
                while ($value = mysqli_fetch_assoc($query_result)) { 
                    $atividade_atual = $value["name"];
                    ?>
                    <?php
                    echo "<li><h3>$atividade_atual</h3></li>";
                    ?>
                    <a class="btn-remove-tarefa" href="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $value["id"] . "&" . "acao=remover" ?>">
                        <button aria-label="Remover" class="btn btn-lg btn-danger" type="button">Remover</button>
                    </a>
                    <?php
                }
            }
            disconnect_database($conn);        
        ?>
    </ul>

    <ul class="quinta">
        <h2>Quinta-Feira</h2>

        <?php
            $conn = connect_database();
            $user_id = $_SESSION["user_id"];
            $sql = "SELECT name, id FROM $table_atividades WHERE userid = '$user_id' and dia_da_semana = 'quinta';";

            $query_result = mysqli_query($conn, $sql);

            if (!$query_result) {
                echo mysqli_error($conn);
            } else {
                while ($value = mysqli_fetch_assoc($query_result)) { 
                    $atividade_atual = $value["name"];
                    ?>
                    <?php
                    echo "<li><h3>$atividade_atual</h3></li>";
                    ?>
                    <a class="btn-remove-tarefa" href="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $value["id"] . "&" . "acao=remover" ?>">
                        <button aria-label="Remover" class="btn btn-lg btn-danger" type="button">Remover</button>
                    </a>
                    <?php
                }
            }
            disconnect_database($conn);
        ?>
    </ul>

    <ul class="sexta">
        <h2>Sexta-Feira</h2>
        <?php
            $conn = connect_database();
            $user_id = $_SESSION["user_id"];
            $sql = "SELECT name, id FROM $table_atividades WHERE userid = '$user_id' and dia_da_semana = 'sexta';";

            $query_result = mysqli_query($conn, $sql);

            if (!$query_result) {
                echo mysqli_error($conn);
            } else {
                while ($value = mysqli_fetch_assoc($query_result)) { 
                    $atividade_atual = $value["name"];
                    ?>
                    <?php
                    echo "<li><h3>$atividade_atual</h3></li>";
                    ?>
                    <a class="btn-remove-tarefa" href="<?php echo $_SERVER["PHP_SELF"] . "?id=" . $value["id"] . "&" . "acao=remover" ?>">
                        <button aria-label="Remover" class="btn btn-lg btn-danger" type="button">Remover</button>
                    </a>
                    <?php
                }
            }
            disconnect_database($conn);
                    
        ?>
    </ul>

</div>
<style>
.segunda li,
.terca li,
.quarta li,
.quinta li,
.sexta li{
  background-color: #f6f6f6;
  color: #0d0d0d;
  text-align: center;
  margin-top: 10px;
  margin-bottom: 5px;
  font-size: 16px;
  list-style-type: none;
  border-radius: 10px;
}
</style>