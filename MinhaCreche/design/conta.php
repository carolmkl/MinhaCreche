<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include '../code/valida_user.php' ?>
        
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <?php include 'import.php' ?>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/vadilacoes.js"></script>
        <script src="js/callPage.js"></script>
        
        <script type="text/javascript">
            
            function apagaErro(){
                $("#divLogin").removeClass("has-error");
                $("#erroLogin").hide();
                $("#erroLogin2").hide();
                $("#divSenha").removeClass("has-error");
                $("#erroSenha").hide();
                $("#erroSenha2").hide();
            }
			
			function goTo(local){
				$('html, body').animate({
					scrollTop: $(local).offset().top
				});
			}
            
            $(document).ready(function() {
                $("#bsubmit").click(function(e) {
                    var vLogin = $("#login").val(), 
                        vSenha = $("#senha").val(), 
                        vIdPessoa = Number($("#id_pessoa").val());
                    
                    var vOpcao = 4;
                    
                    var erros = [];
					var erro = false;
                    
                    apagaErro();
                    
                    if(!validaLogin(vLogin)){
                        erros[erros.length] = "Login inválido. Somente letras, números e '_' de tamanho mínimo 3.";
                        $("#divLogin").addClass("has-error");
                        $("#erroLogin").show();
						if(!erro){
							erro = true;
							goTo("#divLogin");
						}
                    }
                    if((vSenha != "") && !validaSenha(vSenha)){
                        erros[erros.length] = "Senha inválida. Somente letras números e os caracteres !, @, #, $, %, ^, &, *, (), _ de tamanho mínimo 6.";
                        $("#divSenha").addClass("has-error");
                        $("#erroSenha").show();
						if(!erro){
							erro = true;
							goTo("#divSenha");
						}
                    }

                    
                    if(erros.length == 0){
                        $.post("../code/verificacao.php", {
                            operacao: 2,
                            id_pessoafisica : vIdPessoa,
                            login: vLogin,
                            senha: vSenha
                        }, function (retornoV) {
                            console.log(retornoV);
                            var dadosRetornoV = JSON.parse(retornoV);
                            //console.log(dadosRetorno);
                            if (dadosRetornoV == true) {
                                $.post("../code/usuarioCRUD.php", {
                                    operacao: vOpcao,
                                    id_pessoafisica : vIdPessoa,
                                    login: vLogin,
                                    senha: vSenha
                                }, function (retorno) {
                                    //console.log(retorno);
                                    var dadosRetorno = JSON.parse(retorno);
                                    //console.log(dadosRetorno);
                                    if (dadosRetorno == true) {
                                        window.location.replace("../code/endSession.php");
                                    } else {
                                        alert("Ocorreu um erro inesperado ao realizar a operação!");
                                    }
                                });
                            } else if(dadosRetornoV == "login"){
                                $("#divLogin").addClass("has-error");
                                $("#erroLogin2").show();
                                alert("Olhar os campos em vermelho");
                            } else if(dadosRetornoV == "senha"){
                                $("#divSenha").addClass("has-error");
                                $("#erroSenha2").show();
                                alert("Olhar os campos em vermelho");
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
                })
            });
        </script>

    </head>
    <body>
        <div class="container-fluid">
            
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space">Dados do Usuário</h1>
                <div class="spacee">
                    <form role="form" >
                        <input type="hidden" id="id_pessoa" value=<?php echo $_SESSION['mc_pessoa_id']?>>
                         <fieldset>
                            <legend>Acesso ao Sistema</legend>
                            <div id="divLogin" class="form-group">
                                <label class="text" for="login">Login</label>
                                <input class="form-control" type="text" id="login" value=<?php echo $_SESSION['mclogin']?>>
                                <span id="erroLogin" class="help-block hideContent">Login inválido. Somente letras, números e '_' de tamanho mínimo 3.</span>
                                <span id="erroLogin2" class="help-block hideContent">Login já existe.</span>
                            </div>
                            <div id="divSenha" class="form-group">
                                <label for="senha">Senha</label>
                                <input class="form-control" type="password" id="senha" >
                                <span id="erroSenha" class="help-block hideContent">Senha inválida. Somente letras números e os caracteres !, @, #, $, %, ^, &amp;, *, (), _ de tamanho mínimo 6.</span>
                                <span id="erroSenha2" class="help-block hideContent">Senha já existe.</span>
                            </div>
                        </fieldset>
                        
                        <br>
                        
                        <fieldset>
                            <legend>Nível de Acesso</legend>
                            <div class="form-group">
                                <label for="nivel">Nível</label>
                                <input class="form-control" type="text" id="nivel" value=<?php echo $_SESSION['mc_user_nivel']?> disabled>
                            </div>
                        </fieldset>
                        
                        <br>
                        <p id="obrigatorio">Ao alterar os seus dados, você será deslogado e terá de logar novamente</p>
                        <br>

                        <p>
                            <input class='btn btn-success' id='bsubmit' type='button' value='Salvar' />
                            <input class='btn btn-danger' type='button' value='Cancelar' onclick='goBack("home.php");'>    
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>