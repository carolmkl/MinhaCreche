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
                    <input type="text" ng-hide="true" id="id_creche" name="id_creche" ng-model="id_creche">
                    <label class="text" for="nome">Nome</label> <input class="text_big" type="text" id="nome" name="nome" ng-model="nome"> 
                    <label class="text" for="cnpj">CNPJ</label> <input class="text_small" type="text" id="cnpj" name="cnpj" ng-model="cnpj" ><br>
                    

                    <label class="text" for="email">E-mail</label> <input class="text_bigger" type="email" id="email" name="email" ng-model="email"><br>

                    <label class="text" for="telefone1">Telefone 1</label> <input type="text" id="telefone1" name="telefone1" ng-model="telefone1"><br>
                    <label class="text" for="telefone2">Telefone 2</label> <input type="text" id="telefone2" name="telefone2" ng-model="telefone2"><br>

                    <fieldset class="fieldset_border">
                        <legend>Endereço</legend>
                        <label class="text" for="logradouro">Logradouro</label> <input class="text_bigger" type="text" id="logradouro" name="logradouro" ng-model="logradouro"> 
                        <label class="text" for="numero">Numero</label> <input class="text_small" type="text" id="numero" name="numero" ng-model="numero"><br>
                        
                        <label class="text" for="bairro">Bairro</label> <input class="text_big" type="text" id="bairro" name="bairro" ng-model="bairro"> 
                        <label class="text" for="cidade">Cidade</label> <input type="text" id="cidade" name="cidade" ng-model="cidade">
                        <label class="text" for="estado">Estado</label> <input class="text_smaller" type="text" id="estado" name="estado" ng-model="estado"><br>
                        
                        <label class="text" for="observacao">Observação</label><br> 
                        <input class="text_bigger" type="text" id="observacao" name="observacao" ng-model="observacao"><br>
                        
                    </fieldset>
                    <p> <input id="bsubmit" type="submit" value="Salvar" /> <input type="button" value="Cancelar" onclick="goBack();"> </p>
                </form>
                </div>
            </div>
        </div>
        <script src="js/angular.min.js"></script>
        <script src="js/mask.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>