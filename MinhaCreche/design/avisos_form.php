<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <?php include '../code/valida_user.php' ?>
        <?php include 'import.php' ?>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/vadilacoes.js"></script>
        <script src="js/callPage.js"></script>
        
        <script type="text/javascript">
            // variavel global para os responsáveis de uma criança/funcionarios da creche
            var arrayAdulto = [];
            var nivel;
            
            function loadCriancas() {
                $("#crianca").empty();
                var operacao;
                var responsavel = Number($("#idResponsavel").val());
                if(nivel == "Responsavel"){
                    operacao = 7;
                } else {
                    operacao = 8;
                }
                $.post("../code/avisoCRUD.php", {operacao : operacao, id_responsavel: responsavel}, function(retorno){
                    //alert(retorno);
                    dados = JSON.parse(retorno);
                    $('#crianca').append(
                            '<option value="">Selecione</option>');
                    for(var i=0;dados.length>i;i++){
                        $('#crianca').append(
                            '<option value=' + dados[i].id_crianca + '>' + dados[i].nome + '</option>');
			         }
                });
            }
            
            function deleteAdulto(indice){
                arrayAdulto.splice(indice,1);
                preencheTabela();
            }
            
            function preencheTabela(){
                $('#corpoTabela').empty();
                var extra;
                for(var i=0;i < arrayAdulto.length;i++){
                    if(nivel == "Responsavel"){
                            extra = arrayAdulto[i].cargo;
                        } else {
                            extra = arrayAdulto[i].parentesco;
                        }
                    $('#corpoTabela').append(
                        '<tr><td>' + arrayAdulto[i].nome + '</td>' +
                        '<td>' + extra + '</td>' +
                        '<td><button type="button" class="btn btn-sm btn-danger" onclick="deleteAdulto(' + i + ')">Excluir</button></td></tr>');
			         }
            }
            
            function loadAdulto(){
                var id_crianca = Number($("#crianca").val());
                    var operacao;
                    
                    if(id_crianca != ""){
                        if(nivel == "Responsavel"){
                            operacao = 9;
                        } else {
                            operacao = 6;
                        }
                        $.post("../code/avisoCRUD.php", {operacao : operacao, id_crianca: id_crianca}, function(retorno){
                            //alert(retorno);
                            arrayAdulto = JSON.parse(retorno);
                            console.log(arrayAdulto);
                            preencheTabela();
                        });
                    }
            }
            
            function apagaErro(){
                $("#divCrianca").removeClass("has-error");
                $("#erroCrianca").hide();
                $("#divResponsavelErro").removeClass("has-error");
                $("#erroResp").hide();
                $("#divMensagem").removeClass("has-error");
                $("#erroMsg").hide();
            }
            
			function goTo(local){
				$('html, body').animate({
					scrollTop: $(local).offset().top
				});
			}
			
            $(document).ready(function() {
                nivel = $("#nivel").val();
                loadCriancas();
                
                var vIdAviso = Number($("#idAviso").val());
                
                $("#crianca").change(function() {
                    loadAdulto();
                });
                
                $("#resertTabela").click(function() {
                    loadAdulto();
                });
                
                $("#submit").click(function() {
                    var vId_crinca = Number($("#crianca").val()),
                        vId_pessoaFisica = Number($("#idPessoa").val()),
                        vNivel = Number($("#nivelAviso").val()),
                        vDtEnvio = $("#dtEnvio").val(),
                        vMessagem = $("#messagem").val();
                    
                    var vOpcao;
                    if(vIdAviso != 0 ){
                        vOpcao = 4;
                    } else {
                        vOpcao = 3;
                    }
                    
                    apagaErro();
                    
                    var erros = [];
					var erro = false;
					
                    if(vId_crinca == ""){
                        erros.push("Escolha uma criança");
                        $("#divCrianca").addClass("has-error");
                        $("#erroCrianca").show();
						if(!erro){
							erro = true;
							goTo("#divCrianca");
						}
                    }
                    if(arrayAdulto.length == 0){
                        erros.push("Tenha pelo menos um destinatário para enviar");
                        $("#divResponsavelErro").addClass("has-error");
                        $("#erroResp").show();
						if(!erro){
							erro = true;
							goTo("#divResponsavel");
						}
                    }
                    // if da data
                    /*if(){
                        $("#divDtEnvio").addClass("has-error");
                    }*/
                    if(vMessagem.length == 0){
                        erros.push("Mensagem inválida. Digite algo");
                        $("#divMensagem").addClass("has-error");
                        $("#erroMsg").show();
						if(!erro){
							erro = true;
							goTo("#divMensagem");
						}
                    }
                    
                    if(erros.length == 0){
                            //arrumar nivel
                            $.post("../code/avisoCRUD.php", {
                            operacao: vOpcao,    
                            id_aviso: vIdAviso,
                            id_crianca : vId_crinca,
                            id_pessoaFisica : vId_pessoaFisica,
                            nivel : vNivel,
                            dtEnvio : vDtEnvio,
                            messagem : vMessagem,
                            destinatarios : JSON.stringify(arrayAdulto)
                        }, function (retorno) {
                            console.log(retorno);
                            var dadosRetorno = JSON.parse(retorno);
                            console.log(dadosRetorno);
                            if (dadosRetorno == true) {
                                window.location.replace("avisos.php");
                            } else {
                                alert("Ocorreu um erro inesperado ao realizar a operação!");
                            }
                        });
                    } else {
                        var msg = "Corrija estes erros:";
                        for (var i = 0; i<erros.length; i++) {
                            msg += "\n" + erros[i];
                        }
						alert("Olhar os campos em vermelho");
                    }
                });
                
               if(vIdAviso != 0){
                   $.post("../code/avisoCRUD.php", {operacao : 2, id_Aviso: vIdAviso}, function (retorno) {
                       var dadosC = JSON.parse(retorno);
                       //console.log(retorno);
                       
                       var ver = $("#visualizar").val() === "1";
                       $("#crianca").val(dadosC[0].id_crianca);
                       $("#nivelAviso").val(dadosC[0].nivel);
                       $("#dtEnvio").val(dadosC[0].dataEntrega);
                       $("#messagem").val(dadosC[0].tx_mensagem);
                       
                       $("#crianca").prop("disabled", true);
                        
                       if(ver){
                           $("#fieldResp").hide();
                           $("#dtEnvio").prop("disabled", true);
                           $("#messagem").prop("disabled", true);
                           $("#nivelAviso").prop("disabled", true);
                           
                           var pessoa = Number($("#idPessoa").val());
                           $.post("../code/avisoCRUD.php", {operacao : 11, id_Aviso: vIdAviso, id_pessoaFisica: pessoa}, function (retorno) {
                               console.log(retorno);
                           });
                           
                       } else {
                           var arrayTemp = [];
                           if(nivel == "Responsavel"){
                                operacao = 9;
                            } else {
                                operacao = 6;
                            }
                            $.post("../code/avisoCRUD.php", {operacao : operacao, id_crianca: dadosC[0].id_crianca}, function(retorno){
                                console.log(retorno);
                                arrayTemp = JSON.parse(retorno);
                                $.post("../code/avisoCRUD.php", {operacao : 12, id_Aviso: vIdAviso}, function (retorno) {
                                    var adulto = JSON.parse(retorno);
                                    console.log(retorno);
                                    for(i = 0; i<arrayTemp.length; i++){
                                        for(j=0; j<adulto.length;j++){
                                            if(Number(adulto[j].id_pessoaFisica) == Number(arrayTemp[i].id_pessoafisica)){
                                                arrayAdulto.push(arrayTemp[i]);
                                                j = dados.length;
                                            }
                                        }
                                    }

                                    preencheTabela();
                                });
                            });
                        }     
                   });
                }
                
            });
        </script>

    </head>
    <body>
        <div class="container-fluid">
            <?php include 'menu_principal.php';
                $f = 0;
                $visualizar = false;
                $nivel = $_SESSION['mc_user_nivel'];
                $idresp = $_SESSION['mc_responsavel_id'];
                $idpessoa = $_SESSION['mc_pessoa_id'];
                if(isset($_REQUEST["visualizar"])){
                    $visualizar = ($_REQUEST["visualizar"] === "true");
                }
                if(isset($_REQUEST["id"])){
                    $f = $_REQUEST["id"];
                }
                
            ?>

            <div class="conteiner">
                <form action="" autocomplete="on" method="post" id="form" role="form">
                    <?php
                        if($f == 0){
                            echo "<h1 class='space'>Adicionar Aviso</h1>";
                        } else {
                            echo "<h1 class='space'>Editar Aviso</h1>";
                        }
                    ?>
                    <input type="hidden" id="idAviso" value="<?php echo $f; ?>">
                    <input type="hidden" id="nivel" value="<?php echo $nivel; ?>">
                    <input type="hidden" id="idResponsavel" value="<?php echo $idresp; ?>">
                    <input type="hidden" id="idPessoa" value="<?php echo $idpessoa; ?>">
                    <input type="hidden" id="visualizar" value="<?php echo $visualizar; ?>">
                    <div class="spacee">
                        <fieldset>
                            <legend>Dados do Aviso</legend>
                            <div id="divCrianca" class="form-group">
                                <label for="crianca">Criança<sup>*</sup></label>
                                <select class="dropdown form-control" id="crianca" name="crianca" >
                                </select>
                                <span id="erroCrianca" class="help-block hideContent">Escolha uma criança.</span>
                            </div>
                            <div id="divDtEnvio" class="form-group">
                                <label for="dtEnvio">Data de Envio<sup>*</sup></label>
                                <input class="form-control" type="date" id="dtEnvio" name="dtEnvio">
                                <span id="erroData" class="help-block hideContent"></span>
                            </div>    
                            <div id="divNivelAviso" class="form-group">
                                <label for="nivelAviso">Nível<sup>*</sup></label>
                                <select class="dropdown form-control" id="nivelAviso" name="nivelAviso" >
                                    <option value="3">Normal</option>
                                    <option value="2">Médio</option>
                                    <option value="1">Alto</option>
                                </select>
                            </div>    
                        </fieldset>
                        
                        <br>
                        
                        <fieldset id="fieldResp">
                            <legend>Destinatários<sup>*</sup></legend>
                            <!--também botão de todos responsaveis se for funcionario e se for pai com todos os funcionarios-->
                            <div id="divResponsavel" class="form-group" id="tabelaResp">
                                <button type="button" id="resertTabela" class="btn btn-info">Todos</button>
                                <br>
                                <table>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Parentesco</th>
                                        <th></th>
                                    </tr>
                                    <tbody table id="corpoTabela">
                                    </tbody>
                                </table>
                            </div>
                            <div id="divResponsavelErro" class="form-group">
                                <span id="erroResp" class="help-block hideContent">Tenha pelo menos um destinatário para enviar.</span>
                            </div>
                        </fieldset>
                        
                        <br>
                        
                        <fieldset>
                            <legend>Messagem<sup>*</sup></legend>
                            <div class="form-group" id="divMensagem">
                                <label for="messagem">Conteúdo</label>
                                <textarea class="form-control" class="form-control col-xs-12" rows="10" id="messagem" name="messagem" ></textarea>
                                <span id="erroMsg" class="help-block hideContent">Mensagem inválida. Digite algo.</span>
                            </div>
                        </fieldset>
                        
                        <br>
                        <p id="obrigatorio"><sup>*</sup> Campos obrigatórios</p>
                        <br>
                        
                        <p>     
                            <?php
                                if($visualizar){
                                    echo "<input class='btn btn-success' type='button' value='Voltar' onclick='goBack(\"avisos.php\")'>";
                                } else {
                                    echo "<input class='btn btn-success' id='submit' type='button' value='Confirmar' />
                                          <input class='btn btn-danger' type='button' value='Cancelar' onclick='goBack(\"avisos.php\")'>";
                                }
                            ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>