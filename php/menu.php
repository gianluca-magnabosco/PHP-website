<div id="menu" class="main">
    <ul>
        <li id="bem-vindo"><a href="index.php?atividade=bemvindo">Bem vindo à WebFit!</a></li>
        <li><a href="index.php">Página Inicial</a></li>
        <?php if (!$login): ?>
            <li id="login"><a href="login.php">Login</a></li>
            <li id="registro"><a href="cadastro.php">Registre-se</a></li>
        <?php else: ?>
            <li id="atividades"><a href="atividades.php">Painel de atividades</a></li>
            <li id="logout"><a href="logout.php">Logout</a></li>
            <li id="user"><a href="perfil.php">Seu Perfil</a><img src="img/user.png" alt="User image" width=5% height=10%></li>
        <?php endif; ?>
    </ul>
</div>


<div class="icon-webfit">
    <img src="img/webfit.png" alt="Logo Webfit" width=10% height=20%>
</div>
