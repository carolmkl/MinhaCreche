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
        <script src="js/bootstrap.min.js"></script>
        <script src="js/callPage.js"></script>
        <?php include 'import.php' ?>

    </head>
    <body>
        <div class="container-fluid">
            <?php include '../code/valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space">Dados da Creche</h1>
                <div class="spacee">
                    <form role="form" ng-app="minhaCrecheApp" ng-controller="crecheCtrl" ng-submit="updateCreche(id_creche,nome,cnpj,email,telefone1,telefone2,logradouro,numero,bairro,cidade,estado,observacao)" >
                        <input type="text" ng-hide="true" ng-model="id_creche">
                        <div class="form-group">
                            <label class="text" for="nome">Nome</label>
                            <input class="form-control" type="text" ng-model="nome">
                        </div>
                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <input class="form-control" type="text" ng-model="cnpj" >
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" ng-model="email">
                        </div>
                        <div class="form-group">
                            <label for="telefone1">Telefone 1</label>
                            <input class="form-control" type="text" ng-model="telefone1">
                        </div>
                        <div class="form-group">
                            <label for="telefone2">Telefone 2</label>
                            <input  class="form-control"type="text" ng-model="telefone2">
                        </div>
                        
                        <br>
                        
                        <fieldset>
                            <legend>Endereço</legend>
                            <div class="row">
                                <div  class="form-group col-md-9">
                                    <label for="logradouro">Logradouro</label>
                                    <input class="form-control" type="text" ng-model="logradouro"> 
                                </div>
                                <div  class="form-group col-md-3">
                                    <label for="numero">Numero</label>
                                    <input class="form-control" type="text" ng-model="numero">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div  class="form-group col-md-6">
                                    <label for="bairro">Bairro</label>
                                    <input class="form-control" type="text" ng-model="bairro"> 
                                </div>
                                <div  class="form-group col-md-4">
                                    <label for="cidade">Cidade</label>
                                    <input class="form-control" type="text" ng-model="cidade">
                                </div>
                                <div  class="form-group col-md-2">
                                    <label for="estado">Estado</label>
                                    <input class="form-control" type="text" ng-model="estado">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="observacao">Observação</label>
                                <textarea class="form-control" ng-model="observacao"></textarea>
                            </div>
                        </fieldset>
                        
                        <br><br>

                        <p>
                            <?php
                                if($_SESSION['mc_user_nivel'] == "Diretor"){
                                    echo "<input class='btn btn-success' id='bsubmit' type='submit' value='Salvar' />
                                          <input class='btn btn-danger' type='button' value='Cancelar' onclick='goBack(\"home.php\");'>";
                                } else {
                                    echo "<input class='btn btn-success' type='button' value='Voltar' onclick='goBack(\"home.php\");'>";
                                }
                            ?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>