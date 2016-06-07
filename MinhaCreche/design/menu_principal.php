<script type="text/javascript">
	function hideShowMenu() {
		$("#botaoMenu").click(function(e) {
			$("#menu").toggleClass("open");
		});
	}
</script>
<div id="header"> 
    <div class="text_header"> 
        <span class="space_header" id="user_name">
          <?php echo $_SESSION['mc_user_nome']; ?>
        </span> <span class="space_header"><a href="../code/endSession.php">Sair</a></span>
    </div>
</div>
<div id="menu">
	<button id="botaoMenu" class="btn btn-info botaoMenu" type="button" onclick="hideShowMenu()">Menu</button>
    <a href="home.php"><img class="img-responsive img_center" src="img/logo2_0_100.png" alt="Minha Creche"></a>
          <ul class="box">
              <li><a href="creche.php">Creche</a></li>
              <?php 
                if($_SESSION['mc_user_nivel'] == "Diretor" || $_SESSION['mc_user_nivel'] == "Secretário"){
                    echo "<li><a href='funcionarios.php'>Funcionários</a></li>";    
                }
                if($_SESSION['mc_user_nivel'] != "Responsavel"){
                    echo "<li><a href='responsaveis.php'>Responsáveis</a></li>
                          <li><a href='criancas.php'>Crianças</a></li>";
                }
              ?>
              <li><a href="avisos.php">Avisos</a></li>
              <li><a href="conta.php">Conta</a></li>
              <li><a href="../code/endSession.php">Sair</a></li>
          </ul>
</div>
