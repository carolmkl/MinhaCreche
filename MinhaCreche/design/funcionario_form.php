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
        <?php include 'import.php' ?>
        <?php include '../code/valida_user.php' ?>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/callPage.js"></script>
        <script src="js/vadilacoes.js"></script>
        
        <script type="text/javascript">
            
            function apagaErro(){
                $("#divNome").removeClass("has-error");
                $("#erroNome").hide();
                $("#divCpf").removeClass("has-error");
                $("#erroCpf").hide();
                $("#erroCpf2").hide();
                $("#divRg").removeClass("has-error");
                $("#erroRg").hide();
                $("#divEmail").removeClass("has-error");
                $("#erroEmail").hide();
                $("#divTelefone").removeClass("has-error");
                $("#erroTelefone").hide();
                $("#divCelular").removeClass("has-error");
                $("#erroCelular").hide();
                $("#divDtNascimento").removeClass("has-error");
                $("#erroDtNascimento").hide();
                $("#divGenero").removeClass("has-error");
                $("#erroGenero").hide();
                $("#divLogradouro").removeClass("has-error");
                $("#erroLogradouro").hide();
                $("#divNumero").removeClass("has-error");
                $("#erroNumero").hide();
                $("#divBairro").removeClass("has-error");
                $("#erroBairro").hide();
                $("#divCidade").removeClass("has-error");
                $("#erroCidade").hide();
                $("#divEstado").removeClass("has-error");
                $("#erroEstado").hide();
                $("#divObservacao").removeClass("has-error");
                $("#erroObservacao").hide();
                $("#divLogin").removeClass("has-error");
                $("#erroLogin").hide();
                $("#erroLogin2").hide();
                $("#divSenha").removeClass("has-error");
                $("#erroSenha").hide();
                $("#erroSenha2").hide();
                $("#divCargo").removeClass("has-error");
                $("#erroCargo").hide();
            }
			
			function goTo(local){
				$('html, body').animate({
					scrollTop: $(local).offset().top
				});
			}
            
            $(document).ready(function (e) {
                var vIdFunc = Number($("#idFuncionario").val());
                $("#submit").click(function (e) {
                    var vLogin = $("#login").val(), 
                        vSenha = $("#senha").val(), 
                        vNome = $("#nome").val(), 
                        vCpf = $("#cpf").val(), 
                        vRg = $("#rg").val(), 
                        vEmail = $("#email").val(), 
                        vTelefone = $("#telefone").val(), 
                        vCelular = $("#celular").val(), 
                        vDtNascimento = $("#dtNascimento").val(), 
                        vGenero = $("#genero").val(), 
                        vLogradouro = $("#logradouro").val(), 
                        vNumero = $("#numero").val(), 
                        vBairro = $("#bairro").val(), 
                        vCidade = $("#cidade").val(), 
                        vEstado = $("#estado").val(), 
                        vObservacao = $("#observacao").val(), 
                        vCargo = $("#cargo").val(),
                        vIdPessoa = Number($("#idPessoa").val());
                        
                    vCpf = vCpf.replace(/\./g,"");
                    vCpf = vCpf.replace("-","");
                    vTelefone = vTelefone.replace("-","");
                    vCelular = vCelular.replace("-","");
                    
                    apagaErro();
                    
                    var vDestino;
                    var verificaSenha = true;
                    if(vIdFunc != 0 ){
                        vDestino = "../code/funcionarioUpdate.php";
                        verificaSenha = false;
                    } else {
                        vDestino = "../code/funcionarioInsert.php";
                    }
                    
                    var erros = [];
					var erro = false;
					
                    if(!validaLogin(vLogin)){
                        erros[erros.length] = "Login inválido. Somente letras, números e '_' de tamanho mínimo 3.";
                        $("#divLogin").addClass("has-error");
                        $("#erroLogin").show();
						if(!erro){
							erro = true;
							goTo("#divLogin");
						}
                    }
                    if((verificaSenha || vSenha != "") && !validaSenha(vSenha)){
                        erros[erros.length] = "Senha inválida. Somente letras números e os caracteres !, @, #, $, %, ^, &, *, (), _ de tamanho mínimo 6.";
                        $("#divSenha").addClass("has-error");
                        $("#erroSenha").show();
						if(!erro){
							erro = true;
							goTo("#divSenha");
						}
                    }
                    if(!validaNome(vNome)){
                        erros[erros.length] = "Nome inválido. Somente letras e números de tamanho mínimo 3.";
                        $("#divNome").addClass("has-error");
                        $("#erroNome").show();
						if(!erro){
							erro = true;
							goTo("#divNome");
						}
                    }
                    if(!validaRg(vRg)){
                        erros[erros.length] = "RG inválido. Somente os 7 caracteres, sem pontos.";
                        $("#divRg").addClass("has-error");
                        $("#erroRg").show();
						if(!erro){
							erro = true;
							goTo("#divRg");
						}
                    }
                    if(!validaCpf(vCpf)){
                        erros[erros.length] = "CPF inválido. Somente os 11 números.";
                        $("#divCpf").addClass("has-error");
                        $("#erroCpf").show();
						if(!erro){
							erro = true;
							goTo("#divCpf");
						}
                    }
                    if(vEmail != "" && !validaEmail(vEmail)){
                        erros[erros.length] = "Email inválido.";
                        $("#divEmail").addClass("has-error");
                        $("#erroEmail").show();
						if(!erro){
							erro = true;
							goTo("#divEmail");
						}
                    }
                    if(!validaTelefone(vTelefone)){
                        erros[erros.length] = "Telefone inválido. Formato (##) ####### ou (##) ########.";
                        $("#divTelefone").addClass("has-error");
                        $("#erroTelefone").show();
						if(!erro){
							erro = true;
							goTo("#divTelefone");
						}
                    }
                    if(vCelular != "" && !validaTelefone(vCelular)){
                        erros[erros.length] = "Celular inválido. Formato (##) ####### ou (##) ########.";
                        $("#divCelular").addClass("has-error");
                        $("#erroCelular").show();
						if(!erro){
							erro = true;
							goTo("#divCelular");
						}
                    }
                    if(vDtNascimento == ""){
                        erros[erros.length] = "Data de nascimento inválida. Informe uma data.";
                        $("#divDtNascimento").addClass("has-error");
                        $("#erroDtNascimento").show();
						if(!erro){
							erro = true;
							goTo("#divDtNascimento");
						}
                    }
                    if(vGenero == ""){
                        erros[erros.length] = "Selecione o Gênero.";
                        $("#divGenero").addClass("has-error");
                        $("#erroGenero").show();
						if(!erro){
							erro = true;
							goTo("#divGenero");
						}
                    }
                    if(!validaNome(vLogradouro)){
                        erros[erros.length] = "Logradouro inválido. Somente letras e números de tamanho mínimo 3.";
                        $("#divLogradouro").addClass("has-error");
                        $("#erroLogradouro").show();
						if(!erro){
							erro = true;
							goTo("#divLogradouro");
						}
                    }
                    if(!validaNumero(vNumero)){
                        erros[erros.length] = "Número inválido.";
                        $("#divNumero").addClass("has-error");
                        $("#erroNumero").show();
						if(!erro){
							erro = true;
							goTo("#divNumero");
						}
                    }
                    if(!validaNome(vBairro)){
                        erros[erros.length] = "Bairro inválido. Somente letras e números de tamanho mínimo 3.";
                        $("#divBairro").addClass("has-error");
                        $("#erroBairro").show();
						if(!erro){
							erro = true;
							goTo("#divBairro");
						}
                    }
                    if(!validaNome(vCidade)){
                        erros[erros.length] = "Cidade inválida. Somente letras e números de tamanho mínimo 3.";
                        $("#divCidade").addClass("has-error");
                        $("#erroCidade").show();
						if(!erro){
							erro = true;
							goTo("#divCidade");
						}
                    }
                    if(!validaEstado(vEstado)){
                        erros[erros.length] = "Estado inválido. Somente letras e números de tamanho mínimo 3.";
                        $("#divEstado").addClass("has-error");
                        $("#erroEstado").show();
						if(!erro){
							erro = true;
							goTo("#divEstado");
						}
                    }
                    if(vObservacao != "" && !validaNome(vObservacao)){
                        erros[erros.length] = "Observação inválida. Somente letras e números de tamanho mínimo 3.";
                        $("#divObservacao").addClass("has-error");
                        $("#erroObservacao").show();
						if(!erro){
							erro = true;
							goTo("#divObservacao");
						}
                    }
                    if(vCargo == ""){
                        erros[erros.length] = "Selecione o Cargo.";
                        $("#divCargo").addClass("has-error");
                        $("#erroCargo").show();
						if(!erro){
							erro = true;
							goTo("#divCargo");
						}
                    }

                    if(erros.length == 0){
                            $.post("../code/verificacao.php", {
                            operacao : 1,
                            id_pessoafisica : vIdPessoa,
                            cpf : vCpf,
                            login: vLogin,
                            senha: vSenha
                        }, function (retornoV) {
                            console.log(retornoV);
                            var dadosRetornoV = JSON.parse(retornoV);
                            //console.log(dadosRetorno);
                            if (dadosRetornoV == true) {
                                $.post(vDestino, {
                                id_funcionario : vIdFunc,
                                id_pessoafisica : vIdPessoa,
                                nome : vNome,
                                cpf : vCpf,
                                rg : vRg,
                                email : vEmail,
                                telefone : vTelefone,
                                celular : vCelular,
                                dtNascimento : vDtNascimento,
                                genero : vGenero,
                                logradouro : vLogradouro,
                                numero : vNumero,
                                bairro : vBairro,
                                cidade : vCidade,
                                estado : vEstado,
                                observacao : vObservacao,
                                cargo : vCargo,
                                login: vLogin,
                                senha: vSenha
                                }, function (retorno) {
                                    //console.log(retorno);
                                    var dadosRetorno = JSON.parse(retorno);
                                    //console.log(dadosRetorno);
                                    if (dadosRetorno == true) {
                                        window.location.replace("funcionarios.php");
                                    } else {
                                        alert("Ocorreu um erro inesperado ao realizar a operação!");
                                    }
                                });
                            } else if(dadosRetornoV == "login"){
                                $("#divLogin").addClass("has-error");
                                $("#erroLogin2").show();
                                alert("Olhar os campos em vermelho");
                            } else if(dadosRetornoV == "cpf"){
                                $("#divCpf").addClass("has-error");
                                $("#erroCpf2").show();
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
                    
                });
                
                if(vIdFunc != 0){
                    $.post("../code/funcionarioGet.php", {id_funcionario: vIdFunc}, function (retorno) {
                        var dados = JSON.parse(retorno);
                        console.log(dados);
                        
                        $("#login").val();
                        $("#senha").val();
                        $("#nome").val(dados[0].nome);
                        $("#cpf").val(dados[0].cpf);
                        $("#rg").val(dados[0].rg);
                        $("#email").val(dados[0].email);
                        $("#telefone").val(dados[0].telefone);
                        $("#celular").val(dados[0].celular);
                        $("#dtNascimento").val(dados[0].dtNascimento);
                        $("#genero").val(dados[0].genero);
                        $("#logradouro").val(dados[0].logradouro);
                        $("#numero").val(dados[0].numero);
                        $("#bairro").val(dados[0].bairro);
                        $("#cidade").val(dados[0].cidade);
                        $("#estado").val(dados[0].estado);
                        $("#observacao").val(dados[0].observacao);
                        $("#cargo").val(dados[0].cargo);
                        $("#idPessoa").val(dados[0].id_pessoaFisica);
                        $("#idFuncionario").val(dados[0].id_funcionario);
                        
                        $("#login").val(dados[0].login);
                    });
                }
                
                $("#cpf").mask('000.000.000-00');
                /*var options = {onKeyPress: function(tel, e, field, options){
                    var masks = ['(00) 0000-0000', '(00) 00000-0000'];
                    mask = (tel.length > 14)? masks[1] : masks[0];
                    $("#telefone").mask(mask, options);
                }};*/
                $("#telefone").mask('(00) 0000-0000');
                $("#celular").mask('(00) 0000-0000');
            });
            
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include 'menu_principal.php' ?>
            <?php
                $f = 0;
                if(isset($_REQUEST["id"])){
                    $f = $_REQUEST["id"];
                }
            ?>

            <div class="conteiner">
                <form action="" autocomplete="on" method="post" id="form" role="form"> <!--ng-app="minhaCrecheApp" ng-controller="funcionarioCtrl" ng-submit="salvaFuncionario(login,senha,nome,cpf,rg,email,telefone,celular,ndtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao,cargo)" --> 
                    <?php
                        if($f == 0){
                            echo "<h1 class='space'>Adicionar Funcionário</h1>";
                        } else {
                            echo "<h1 class='space'>Editar Funcionário</h1>";
                        }
                    ?>
                    <input type="hidden" id="idFuncionario" value="<?php echo $f; ?>">
                    <input type="hidden" id="idPessoa" value="">
                    <div class="spacee">

                        <fieldset>
                            <legend>Acesso ao Sistema</legend>
                            <div id="divLogin" class="form-group">
                                <label for="login">Login<sup>*</sup></label>
                                <input class="form-control" type="text" value="" size="20" id="login" ng-model="login" required>
                                <span id="erroLogin" class="help-block hideContent">Login inválido. Somente letras, números e '_' de tamanho mínimo 3.</span>
                                <span id="erroLogin2" class="help-block hideContent">Login já existe.</span>
                            </div>
                            <div id="divSenha" class="form-group">
                                <label for="senha">Senha<sup>*</sup></label>
                                <input class="form-control" type="password" value="" size="20" id="senha" ng-model="senha" required>
                                <span id="erroSenha" class="help-block hideContent">Senha inválida. Somente letras números e os caracteres !, @, #, $, %, ^, &amp;, *, (), _ de tamanho mínimo 6.</span>
                                <span id="erroSenha2" class="help-block hideContent">Senha já existe.</span>
                            </div>
                        </fieldset>
                        
                        <br>

                        <fieldset>
                            <legend>Dados Pessoais</legend>
                            <div class="row">
                                <div id="divNome" class="form-group col-md-6">
                                    <label for="nome">Nome<sup>*</sup></label>
                                    <input class="form-control" type="text" id="nome" ng-model="nome"> 
                                    <span id="erroNome" class="help-block hideContent">Nome inválido. Somente letras e números de tamanho mínimo 3.</span>
                                </div>
                                <div id="divRg" class="form-group col-md-3">
                                    <label for="rg">RG<sup>*</sup></label>
                                    <input class="form-control" type="text" id="rg" ng-model="rg" >
                                    <span id="erroRg" class="help-block hideContent">RG inválido. Somente os 7 caracteres, sem pontos.</span>
                                </div>
                                <div id="divCpf" class="form-group col-md-3">
                                    <label for="cpf">CPF<sup>*</sup></label>
                                    <input class="form-control" type="text" id="cpf" ng-model="cpf" >
                                    <span id="erroCpf" class="help-block hideContent">CPF inválido. Somente os 11 números.</span>
                                    <span id="erroCpf2" class="help-block hideContent">CPF já existe.</span>
                                </div>
                            </div>
                                
                            <div id="divEmail" class="form-group">
                                <label for="email">E-mail</label>
                                <input class="form-control" type="email" id="email" ng-model="email" >
                                <span id="erroEmail" class="help-block hideContent">Email inválido.</span>
                            </div>
                            
                            <div class="row">
                                <div id="divTelefone" class="form-group col-md-6">
                                    <label for="telefone">Telefone<sup>*</sup></label>
                                    <input class="form-control" type="tel" id="telefone" ng-model="telefone" >
                                    <span id="erroTelefone" class="help-block hideContent">Telefone inválido. Formato (##) ####### ou (##) ########.</span>
                                </div>
                                <div id="divCelular" class="form-group col-md-6">
                                    <label for="celular">Celular</label>
                                    <input class="form-control" type="tel" id="celular" ng-model="celular" >
                                    <span id="erroCelular" class="help-block hideContent">Celular inválido. Formato (##) ####### ou (##) ########.</span>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div id="divDtNascimento" class="form-group col-md-6">
                                    <label for="dtNascimento">Data de Nascimento<sup>*</sup></label>
                                    <input class="form-control" type="date" id="dtNascimento" ng-model="dtNascimento" >
                                    <span id="erroDtNascimento" class="help-block hideContent">Data de nascimento inválida. Informe uma data.</span>
                                </div>
                                <div id="divGenero" class="form-group col-md-6">
                                    <label class="text" for="genero">Gênero<sup>*</sup></label>
                                    <select placeholder="Selecione" class="dropdown form-control" id="genero" ng-model="genero" >
                                        <option value="">Selecione</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                    </select>
                                    <span id="erroGenero" class="help-block hideContent">Selecione o Gênero.</span>
                                </div>
                            </div>    
                        </fieldset>

                        <br>

                        <fieldset>
                            <legend>Endereço</legend>
                            <div class="row">
                                <div id="divLogradouro" class="form-group col-md-9">
                                    <label for="logradouro">Logradouro<sup>*</sup></label>
                                    <input class="form-control" type="text" id="logradouro" ng-model="logradouro" > 
                                    <span id="erroLogradouro" class="help-block hideContent">Logradouro inválido. Somente letras e números de tamanho mínimo 3.</span>
                                </div>
                                <div id="divNumero" class="form-group col-md-3">
                                    <label for="num">Numero<sup>*</sup></label>
                                    <input class="form-control" type="number" id="numero" ng-model="numero" >
                                    <span id="erroNumero" class="help-block hideContent">Número inválido.</span>
                                </div>
                            </div>    
                            
                            <div class="row">
                                <div id="divBairro" class="form-group col-md-6">
                                    <label for="bairro">Bairro<sup>*</sup></label>
                                    <input class="form-control" type="text" id="bairro" ng-model="bairro" > 
                                    <span id="erroBairro" class="help-block hideContent">Bairro inválido. Somente letras e números de tamanho mínimo 3.</span>
                                </div>
                                <div id="divCidade" class="form-group col-md-4">
                                    <label for="cidade">Cidade<sup>*</sup></label>
                                    <input class="form-control" type="text" id="cidade" ng-model="cidade" >
                                    <span id="erroCidade" class="help-block hideContent">Cidade inválida. Somente letras e números de tamanho mínimo 3.</span>
                                </div>
                                <div id="divEstado" class="form-group col-md-2">
                                    <label for="estado">Estado<sup>*</sup></label>
                                    <input class="form-control" type="text" id="estado" ng-model="estado" >
                                    <span id="erroEstado" class="help-block hideContent">Estado inválido. Somente letras e números de tamanho mínimo 2.</span>
                                </div>
                            </div>    
                            <div id="divObservacao" class="form-group">
                                <label for="observacao">Observação</label> 
                                <input class="form-control" type="text" id="observacao" ng-model="observacao" >
                                <span id="erroObservacao" class="help-block hideContent">Observação inválida. Somente letras e números de tamanho mínimo 3.</span>
                            </div>
                        </fieldset>

                        <br>
                        <div id="divCargo" class="form-group">
                            <label for="cargo">Perfil<sup>*</sup></label>
                            <select class="dropdown form-control" for="cargo" id="cargo" ng-model="cargo" >
                                <option value="">Selecione</option>
                                <option value="Diretor">Diretor</option>
                                <option value="Secretário">Secretário</option>
                                <option value="Professor">Professor</option>
                            </select>
                            <span id="erroCargo" class="help-block hideContent">Selecione o Cargo.</span>
                        </div>

                        <br>
                        <p id="obrigatorio"><sup>*</sup> Campos obrigatórios</p>
                        <br>

                        <p> 
                            <input class="btn btn-success" id="submit" type="button" value="Confirmar" /><!--ng-click="salvaFuncionario(login,senha,nome,cpf,rg,email,telefone,celular,ndtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao,cargo)"-->
                            <input class="btn btn-danger" type="button" value="Cancelar" onclick="goBack('funcionarios.php')">
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>