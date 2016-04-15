<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <script src="js/vadilacoes.js"></script>
        <?php include '../code/valida_user.php' ?>
        <?php include 'import.php' ?>
        <script src="js/callPage.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                
                var vIdResp = Number($("#idResponsavel").val());
                $("#submit").click(function (e) {
                    var vLogin = $("#login").val(), 
                        vSenha = $("#senha").val(), 
                        vNome = $("#nome").val(), 
                        vCpf = $("#cpf").val(), 
                        vRg = $("#rg").val(), 
                        vEmail = $("#email").val(), 
                        vTelefone = $("#telefone").val(), 
                        vTelefoneCom  = $("#telefoneCom").val(), 
                        vCelular = $("#celular").val(), 
                        vDtNascimento = $("#dtNascimento").val(), 
                        vGenero = $("#genero").val(), 
                        vLogradouro = $("#logradouro").val(), 
                        vNumero = $("#numero").val(), 
                        vBairro = $("#bairro").val(), 
                        vCidade = $("#cidade").val(), 
                        vEstado = $("#estado").val(), 
                        vObservacao = $("#observacao").val(), 
                        vProfissao = $("#profissao").val(),
                        vIdPessoa = Number($("#idPessoa").val());
                        
                    vCpf = vCpf.replace(/\./g,"");
                    vCpf = vCpf.replace("-","");
                    vTelefone = vTelefone.replace("-","");
                    vTelefoneCom = vTelefoneCom.replace("-","");
                    vCelular = vCelular.replace("-","");
                    
                    var vOpcao;
                    var verificaSenha = true;
                    if(vIdResp != 0 ){
                        vOpcao = 4;
                        verificaSenha = false;
                    } else {
                        vOpcao = 3;
                    }
                    
                    var erros = [];
                    
                    if(!validaNome(vNome)){
                        erros[erros.length] = "Nome inválido. Somente letras e números de tamanho mínimo 3."
                        $("#nome").css("border-color", "red");
                    }
                    if(!validaCpf(vCpf)){
                        erros[erros.length] = "CPF inválido. Somente os 11 números."
                        $("#cpf").css("border-color", "red");
                    }
                    if(!validaRg(vRg)){
                        erros[erros.length] = "RG inválido. Somente os 5 caracteres, sem pontos."
                        $("#rg").css("border-color", "red");
                    }
                    if(vEmail != "" && !validaEmail(vEmail)){
                        erros[erros.length] = "Email inválido."
                        $("#email").css("border-color", "red");
                    }
                    if(!validaTelefone(vTelefone)){
                        erros[erros.length] = "Telefone inválido. Formato (##) ####### ou (##) ########."
                        $("#telefone").css("border-color", "red");
                    }
                    if(vCelular != "" && !validaTelefone(vCelular)){
                        erros[erros.length] = "Celular inválido. Formato (##) ####### ou (##) ########."
                        $("#celular").css("border-color", "red");
                    }
                    if(vTelefoneCom != "" && !validaTelefone(vTelefoneCom)){
                        erros[erros.length] = "Telefone Comercial inválido. Formato (##) ####### ou (##) ########."
                        $("#telefoneCom").css("border-color", "red");
                    }
                    if(!validaNome(vProfissao)){
                        erros[erros.length] = "Profissão inválida. Somente letras e números de tamanho mínimo 3."
                        $("#profissao").css("border-color", "red");
                    }
                    if(vDtNascimento == ""){
                        erros[erros.length] = "Data de nascimento inválida. Informe uma data."
                        $("#dtNascimento").css("border-color", "red");
                    }
                    if(vGenero == ""){
                        erros[erros.length] = "Selecione o Gênero."
                    }
                    if(!validaNome(vLogradouro)){
                        erros[erros.length] = "Logradouro inválido. Somente letras e números de tamanho mínimo 3."
                        $("#logradouro").css("border-color", "red");
                    }
                    if(!validaNumero(vNumero)){
                        erros[erros.length] = "Número inválido."
                        $("#numero").css("border-color", "red");
                    }
                    if(!validaNome(vBairro)){
                        erros[erros.length] = "Bairro inválido. Somente letras e números de tamanho mínimo 3."
                        $("#bairro").css("border-color", "red");
                    }
                    if(!validaNome(vCidade)){
                        erros[erros.length] = "Cidade inválida. Somente letras e números de tamanho mínimo 3."
                        $("#cidade").css("border-color", "red");
                    }
                    if(!validaEstado(vEstado)){
                        erros[erros.length] = "Estado inválido. Somente letras e números de tamanho mínimo 3."
                        $("#estado").css("border-color", "red");
                    }
                    if(vObservacao != "" && !validaNome(vObservacao)){
                        erros[erros.length] = "Observação inválida. Somente letras e números de tamanho mínimo 3."
                        $("#observacao").css("border-color", "red");
                    }
                    if(!validaLogin(vLogin)){
                        erros[erros.length] = "Login inválido. Somente letras, números e '_' de tamanho mínimo 3."
                        $("#login").css("border-color", "red");
                    }
                    if((verificaSenha || vSenha != "") && !validaSenha(vSenha)){
                        erros[erros.length] = "Senha inválida. Somente letras números e os caracteres !, @, #, $, %, ^, &, *, (), _ de tamanho mínimo 6."
                        $("#senha").css("border-color", "red");
                    }

                    if(erros.length == 0){
                            $.post("../code/responsavelCRUD.php", {
                            operacao: vOpcao,    
                            id_responsavel : vIdResp,
                            id_pessoafisica : vIdPessoa,
                            nome : vNome,
                            cpf : vCpf,
                            rg : vRg,
                            email : vEmail,
                            telefone : vTelefone,
                            celular : vCelular,
                            telefoneCom : vTelefoneCom,
                            dtNascimento : vDtNascimento,
                            genero : vGenero,
                            logradouro : vLogradouro,
                            numero : vNumero,
                            bairro : vBairro,
                            cidade : vCidade,
                            estado : vEstado,
                            observacao : vObservacao,
                            profissao : vProfissao,
                            login: vLogin,
                            senha: vSenha
                        }, function (retorno) {
                            console.log(retorno);
                            var dadosRetorno = JSON.parse(retorno);
                            console.log(dadosRetorno);
                            if (dadosRetorno == true) {
                                window.location.replace("responsaveis.php");
                            } else {
                                alert("Ocorreu um erro inesperado ao realizar a operação!");
                            }
                        });
                    } else {
                        var msg = "Corrija estes erros:";
                        for (var i = 0; i<erros.length; i++) {
                            msg += "\n" + erros[i];
                        }
                        alert(msg);
                    }
                    
                });
                
                if(vIdResp != 0){
                    $.post("../code/responsavelCRUD.php", {operacao : 2, id_responsavel: vIdResp}, function (retorno) {
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
                        $("#TelefoneCom").val(dados[0].telefoneCom);
                        $("#profissao").val(dados[0].profissao);
                        $("#dtNascimento").val(dados[0].dtNascimento);
                        $("#genero").val(dados[0].genero);
                        $("#logradouro").val(dados[0].logradouro);
                        $("#numero").val(dados[0].numero);
                        $("#bairro").val(dados[0].bairro);
                        $("#cidade").val(dados[0].cidade);
                        $("#estado").val(dados[0].estado);
                        $("#observacao").val(dados[0].observacao);
                        $("#idPessoa").val(dados[0].id_pessoaFisica);
                        $("#idResponsavel").val(dados[0].id_responsavel);
                        
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
                $("#telefoneCom").mask('(00) 0000-0000');
                
            });        
            
        </script>

    </head>
    <body>
        <div>
            <?php include 'menu_principal.php';
                $f = 0;
                if(isset($_REQUEST["id"])){
                    $f = $_REQUEST["id"];
                }
            ?>

            <div class="conteiner">
                <form action="" autocomplete="on" method="post" id="form" >
                    <?php
                        if($f == 0){
                            echo "<h1 class='space'>Adicionar Responsável</h1>";
                        } else {
                            echo "<h1 class='space'>Editar Responsável</h1>";
                        }
                    ?>
                    <input type="hidden" id="idResponsavel" value="<?php echo $f; ?>">
                    <input type="hidden" id="idPessoa" value="">
                    <div class="space">

                        <fieldset class="fieldset_border">
                            <legend>Acesso ao Sistema</legend>
                            <label class="text" for="name">Login<sup>*</sup></label>
                            <input class="width" type="text" value="" size="20" id="login" ng-model="login" required><br>
                            <label class="text" for="name">Senha<sup>*</sup></label>
                            <input class="width" type="password" value="" size="20" id="senha" ng-model="senha" required><br>
                        </fieldset><br><br>

                        <fieldset class="fieldset_border">
                            <legend>Dados Pessoais</legend>
                            <label class="text" for="name">Nome<sup>*</sup></label>
                            <input class="text_big" type="text" id="nome" ng-model="nome"> 
                            <label class="text" for="rg">RG<sup>*</sup></label>
                            <input class="text_small" type="text" id="rg" ng-model="rg" >
                            <label class="text" for="cpf">CPF<sup>*</sup></label>
                            <input class="text_small" type="text" id="cpf" ng-model="cpf" ><br>
                            <label class="text" for="mail">E-mail</label>
                            <input class="text_bigger" type="email" id="email" ng-model="email" ><br>
                            <label class="text" for="telefone">Telefone<sup>*</sup></label>
                            <input type="tel" id="telefone" ng-model="telefone" >
                            <label class="text" for="telefoneCom">Telefone Comercial</label>
                            <input type="tel" id="telefoneCom" ng-model="telefoneCom" ><br>
                            <label class="text" for="celular">Celular</label>
                            <input type="tel" id="celular" ng-model="celular" ><br>
                            <label class="text" for="profissao">Profissao</label>
                            <input type="text" id="profissao" ng-model="profissao" ><br>
                            <label class="text" for="nascimento">Data de Nascimento<sup>*</sup></label>
                            <input type="date" id="dtNascimento" ng-model="dtNascimento" >
                            <label class="text" for="celular">Gênero<sup>*</sup></label>
                            <select placeholder="Selecione" class="dropdown" for="genero" id="genero" ng-model="genero" >
                                    <option value="">Selecione</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                            </select>
                        </fieldset>

                        <br>
                        <br>

                        <fieldset class="fieldset_border">
                            <legend>Endereço</legend>
                            <label class="text" for="logradouro">Logradouro<sup>*</sup></label>
                            <input class="text_bigger" type="text" id="logradouro" ng-model="logradouro" > 
                            <label class="text" for="num">Numero<sup>*</sup></label>
                            <input class="text_small" type="number" id="numero" ng-model="numero" ><br>
                            <label class="text" for="bairro">Bairro<sup>*</sup></label>
                            <input class="text_big" type="text" id="bairro" ng-model="bairro" > 
                            <label class="text" for="city">Cidade<sup>*</sup></label>
                            <input type="text" id="cidade" ng-model="cidade" >
                            <label class="text" for="state">Estado<sup>*</sup></label>
                            <input class="text_smaller" type="text" id="estado" ng-model="estado" ><br>
                            <label class="text" for="obs">Observação</label> 
                            <input class="text_bigger" type="text" id="observacao" ng-model="observacao" ><br>
                        </fieldset>
                        <br>
                        <p id="obrigatorio"><sup>*</sup> Campos obrigatórios</p>
                        <br>

                        <p> 
                            <input id="submit" type="button" value="Confirmar" />
                            <input type="button" value="Cancelar" onclick="goBack()">
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>