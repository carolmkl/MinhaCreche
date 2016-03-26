<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <script src="js/callPage.js"></script>
        
    </head>
    <body>
        <div>
            <?php include '../code/valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space_title">Funcionários <input type="image" class="icon" src="img/plus-circle-outline.png" onclick="callRegister('funcionario_form.php', 'Funcionário')"></h1>
                <div class="space" ng-app="minhaCrecheApp" ng-controller="funcionarioCtrl">
                    
                    <table>
                        <tr>
                            <th>Cargo</th>
                            <th>Nome</th>
                            <th>Celular</th>
                            <th></th>
                        </tr>
                        <tr ng-repeat="x in funcionarios">
                            <td>{{ x.cargo }}</td>
                            <td>{{ x.nome }}</td>
                            <td>{{ x.celular }}</td>
                            <td><a href="javascript:;" ng-click="deleteFuncionario({{x.id_funcionario}})" class="btn btn-sm btn-danger">Excluir</a>
                            <a class="btn btn-sm btn-info" href='funcionario_form.php?id_funcionario={{x.id_funcionario}}'>Editar</a>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        <script src="js/angular.min.js"></script>
        <script src="js/mask.min.js"></script>
        <script src="js/app.js"></script>
    </body>
</html>