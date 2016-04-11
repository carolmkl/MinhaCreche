<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <?php include '../code/valida_user.php' ?>
        <?php include 'import.php' ?>
        <script src="js/callPage.js"></script>
        

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
                    <input type="hidden" id="idFuncionario" value="<?php echo $f; ?>">
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
                            <input type="tel" id="telefoneCom" ng-model="telefone" ><br>
                            <label class="text" for="celular">Celular</label>
                            <input type="tel" id="celular" ng-model="celular" ><br>
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