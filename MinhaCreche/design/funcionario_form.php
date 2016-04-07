<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <script src="js/callPage.js"></script>
        <?php include 'import.php' ?>
        
        <script type="text/javascript">
            $(document).ready(function (e) {
                $("#submit").click(function (e) {
                    var cont = 0;
                     $("#form").each(function() {
                        if($(this).val() == "") {
                            $(this).css({"border" : "1px solid #F00"});
                            cont++;
                        }
                    });
                    if(cont == 0) {
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
                            vCargo = $("#cargo").val();

                        $.post("../code/funcionarioInsert.php", {
                            id_funcionario : 0,
                            id_pessoafisica : 0,
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
                            //alert(retorno)
                            if (retorno == true) {
                                window.location.replace("funcionarios.php");
                            } else {
                                alert("Ocorreu um erro inesperado ao realizar o cadastro!");
                            }
                        });
                    }
                });
            });
        </script>
    </head>
    <body>
        <div>
            <?php include '../code/valida_user.php' ?>
            <?php include 'menu_principal.php' ?>
            <?php
                $f = 0;
                if(isset($_REQUEST["f"])){
                    $f = $_REQUEST["f"];
                    echo "<script>alert('<h1>func={$f}</h1>');</script>";
                }
            ?>

            <div class="conteiner">
                <form action="" autocomplete="on" method="post" id="form" > <!--ng-app="minhaCrecheApp" ng-controller="funcionarioCtrl" ng-submit="salvaFuncionario(login,senha,nome,cpf,rg,email,telefone,celular,ndtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao,cargo)" --> 
                    <h1 ng-hide="$scope.id_funcionario" class="space">Adicionar Funcionário</h1>
                    <h1 ng-show="$scope.id_funcionario" class="space">Editar Funcionário</h1>
                    <div class="space">

                        <fieldset class="fieldset_border">
                            <legend>Acesso ao Sistema</legend>
                            <label class="text" for="name">Login</label>
                            <input class="width" type="text" value="" size="20" id="login" ng-model="login" required><br>
                            <label class="text" for="name">Senha</label>
                            <input class="width" type="password" value="" size="20" id="senha" ng-model="senha" required><br>
                        </fieldset><br><br>

                        <fieldset class="fieldset_border">
                            <legend>Dados Pessoais</legend>
                            <label class="text" for="name">Nome</label>
                            <input class="text_big" type="text" id="nome" ng-model="nome"> 
                            <label class="text" for="rg">RG</label>
                            <input class="text_small" type="text" id="rg" ng-model="rg" >
                            <label class="text" for="cpf">CPF</label>
                            <input class="text_small" type="text" id="cpf" ng-model="cpf" ><br>
                            <label class="text" for="mail">E-mail</label>
                            <input class="text_bigger" type="email" id="email" ng-model="email" ><br>
                            <label class="text" for="telefone">Telefone</label>
                            <input type="tel" id="telefone" ng-model="telefone" >
                            <label class="text" for="celular">celular</label>
                            <input type="tel" id="celular" ng-model="celular" ><br>
                            <label class="text" for="nascimento">Data de Nascimento</label>
                            <input type="date" id="dtNascimento" ng-model="dtNascimento" >
                            <label class="text" for="celular">Gênero</label>
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
                            <label class="text" for="logradouro">Logradouro</label>
                            <input class="text_bigger" type="text" id="logradouro" ng-model="logradouro" > 
                            <label class="text" for="num">Numero</label>
                            <input class="text_small" type="number" id="numero" ng-model="numero" ><br>
                            <label class="text" for="bairro">Bairro</label>
                            <input class="text_big" type="text" id="bairro" ng-model="bairro" > 
                            <label class="text" for="city">Cidade</label>
                            <input type="text" id="cidade" ng-model="cidade" >
                            <label class="text" for="state">Estado</label>
                            <input class="text_smaller" type="text" id="estado" ng-model="estado" ><br>
                            <label class="text" for="obs">Observação</label> 
                            <input class="text_bigger" type="text" id="observacao" ng-model="observacao" ><br>
                        </fieldset>

                        <br>
                        <br>
                        <label class="text" for="cargo">Perfil</label>
                        <select class="dropdown" for="cargo" id="cargo" ng-model="cargo" >
                                <option value="">Selecione</option>
                                <option value="Diretor">Diretor</option>
                                <option value="Secretário">Secretário</option>
                                <option value="Professor">Professor</option>
                        </select>

                        <br>
                        <br>

                        <p> 
                            <input id="submit" type="button" value="Confirmar" /><!--ng-click="salvaFuncionario(login,senha,nome,cpf,rg,email,telefone,celular,ndtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao,cargo)"-->
                            <input type="button" value="Cancelar" onclick="goBack()">
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>