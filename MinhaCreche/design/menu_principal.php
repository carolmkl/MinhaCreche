<div id="header"> 
    <div class="text_header"> 
        <span class="space_header" id="user_name">
          <?php echo $_SESSION['mc_user_nome']; ?>
        </span> <span class="space_header"><a href="../code/endSession.php">Sair</a></span>
    </div>
</div>
<div id="menu">
    <span class="img_center"><a href="home.php"><img class="logo" src="img/logo2_0_100.png" alt="Minha Creche"></a></span>
          <ul class="box">
              <li><a href="creche.php">Creche</a></li>
              <li><a href="funcionarios.php">Funcionários</a></li>
              <!-- <li><a href="#">Turmas</a></li>-->
              <li><a href="responsaveis.php">Responsáveis</a></li>
              <li><a href="criancas.php">Crianças</a></li>
              <!-- <li><a href="#">Medicamentos</a></li> -->
              <li><a href="avisos.php">Avisos</a></li>
              <!-- <li><a href="#">Recessos</a></li>
              <li><a href="#">Atividades</a></li> -->
              <li><a href="../code/endSession.php">Sair</a></li>
          </ul>
</div>
<script src="js/angular.min.js"></script>
<script src="js/angular-route.js"></script>
<script src="js/app.js"></script>
