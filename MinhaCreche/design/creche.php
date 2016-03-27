<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
    </head>
    <body>
        <div>
            <?php include '../code/valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space">Dados da Creche</h1>
                <div class="space">
                    <form ng-app="minhaCrecheApp" ng-controller="crecheCtrl" ng-submit="updateCreche(id_creche,nome,cnpj,email,telefone1,telefone2,logradouro,numero,bairro,cidade,estado,observacao)" >
                        <input type="text" ng-hide="true" ng-model="id_creche">
                        <label class="text" for="nome">Nome</label>
                        <input class="text_big" type="text" ng-model="nome"> 
                        <label class="text" for="cnpj">CNPJ</label>
                        <input class="text_small" type="text" ng-model="cnpj" ><br>
                        <label class="text" for="email">E-mail</label>
                        <input class="text_bigger" type="email" ng-model="email"><br>
                        <label class="text" for="telefone1">Telefone 1</label>
                        <input type="text" ng-model="telefone1"><br>
                        <label class="text" for="telefone2">Telefone 2</label>
                        <input type="text" ng-model="telefone2"><br><br>

                        <fieldset class="fieldset_border">
                            <legend>Endereço</legend>
                            <label class="text" for="logradouro">Logradouro</label>
                            <input class="text_bigger" type="text" ng-model="logradouro"> 
                            <label class="text" for="numero">Numero</label>
                            <input class="text_small" type="text" ng-model="numero"><br>
                            <label class="text" for="bairro">Bairro</label>
                            <input class="text_big" type="text" ng-model="bairro"> 
                            <label class="text" for="cidade">Cidade</label>
                            <input type="text" ng-model="cidade">
                            <label class="text" for="estado">Estado</label>
                            <input class="text_smaller" type="text" ng-model="estado"><br>
                            <label class="text" for="observacao">Observação</label><br> 
                            <input class="text_bigger" type="text" ng-model="observacao"><br>
                        </fieldset>
                        
                        <br><br>

                        <p>
                            <input id="bsubmit" type="submit" value="Salvar" />
                            <input type="button" value="Cancelar" onclick="goBack();">
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>