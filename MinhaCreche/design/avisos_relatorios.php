<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <script src="js/callPage.js"></script>
        <?php include '../code/valida_user.php'; ?>
        <?php include 'import.php' ?>
        
        <script type="text/javascript">
			
			google.load("visualization", "1", {packages:["table"]});
			google.load("visualization", "1", {packages:["bar"]});
			google.load("visualization", "1", {packages:["corechart"]});
            
			function drawChart(dadosRelatorio, visual){
				var dados = new google.visualization.DataTable(dadosRelatorio);
				var div = document.getElementById('dadosRelatorio');
				var chart;
				if(visual === "tabela"){
					chart = new google.visualization.Table(div);
				} else {
					chart = new google.visualization.ColumnChart(div);
				}
				var options = {'width':'100%', 'height' : '500px', 'isStacked': 'true'};
				chart.draw(dados, options);
				
//				
			}
			
            $(document).ready(function(e) {
				
				$("#gerar").click(function (){
					var vTipo = $("#tipoRelatorio").val();
					var vVisual = $("#visual").val();
					var vInicio = $("#inicio").val();
					var vFim = $("#fim").val();
					
					var operacao;
					
					if(vTipo === "crianca"){
						operacao = 13;
					} else if(vTipo === "responsavel"){
						operacao = 14;
					} else {
						operacao = 15;
					}
					
					$.post("../code/avisoCRUD.php", {operacao : operacao, tipo: vVisual, inicio : vInicio, fim : vFim}, function (retorno){
						console.log(retorno);
						var dadosRelatorio = JSON.parse(retorno);
						
						if(!dadosRelatorio.erro){
							$("#semDados").hide();
							$("#dadosRelatorio").show();
							google.setOnLoadCallback(drawChart(dadosRelatorio.content, vVisual));
						} else {
							$("#semDados").show();
							$("#dadosRelatorio").hide();
						}
						
					});
					
				});
            });
            
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include 'menu_principal.php'; 
                $idpessoa = $_SESSION['mc_pessoa_id'];
            ?>

            <div class="conteiner">
                <h1 class="space_title">Relatórios de Avisos</h1>
                
                <input type="hidden" id="idPessoa" value="<?php echo $idpessoa; ?>">
                <div class="spacee">
					<fieldset>
						<legend>Opções de relatórios</legend>
						<div class="form-group">
							<label for="tipoRelatorio">Dados para o relatório</label>
							<select placeholder="Avisos por Criança" class="dropdown form-control" for="genero" id="tipoRelatorio">
								<option value="crianca">Avisos por Criança</option>
								<option value="responsavel">Avisos por Responsáveis/Funcionarios</option>
								<option value="data">Avisos por Data</option>
							</select>
						</div>
						<div class="form-group">
							<label for="visual">Vizualização de relatório</label>
							<select placeholder="Tabela" class="dropdown form-control" for="genero" id="visual">
								<option value="tabela">Tabela</option>
<!--								<option value="pizza">Pizza</option>-->
								<option value="barras">Coluna/Barra</option>
							</select>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="inicio">Data de Inicio</label>
								<input class="form-control" type="date" id="inicio">
							</div>
							<div class="form-group col-md-6">
								<label for="fim">Data de Fim</label>
								<input class="form-control" type="date" id="fim">
							</div>
						</div>
					</fieldset>

					<br>
					<br>

					<p> 
						<input class="btn btn-success" id="gerar" type="button" value="Gerar" />
						<input class="btn btn-danger" type="button" value="Cancelar" onclick="goBack('avisos.php')">
					</p>
					<div>
						<p id="semDados" class="hideContent">Sem dados para serem exibidos</p>
					</div>
					<div id="dadosRelatorio" class="fill">
					</div>
                </div>
            </div>
        </div>
    </body>
</html>