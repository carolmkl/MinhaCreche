<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <link rel="stylesheet" href="css/modal.css" type="text/css">
		<?php include 'import.php' ?>
        <script src="js/callPage.js"></script>
        
        <script type="text/javascript">
            function callform(id) {
                window.location = "funcionario_form.php?id="+id;
            }
        </script>
        
    </head>
    <body>
        <div class="container-fluid">
            <?php include '../code/valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space_title">Funcionários <a href="funcionario_form.php"><img class="icon" src="img/plus-circle-outline.png" alt="Adicionar Funcionário"></a></h1>
                <div class="space" ng-app="minhaCrecheApp" ng-controller="funcionarioListCtrl">
                    
                    <table>
                        <tr>
                            <th>Cargo</th>
                            <th>Nome</th>
                            <th>Celular</th>
                            <th></th>
                        </tr>
                        <tr ng:repeat="func in funcionarios">
                            <td>{{ func.cargo }}</td>
                            <td>{{ func.nome }}</td>
                            <td>{{ func.celular }}</td>
                            <td><a ng:click="deleteFuncionario(func.id_funcionario, func.id_pessoaFisica)" class="btn btn-sm btn-danger">Excluir</a>
                            <button class="btn btn-sm btn-info" id={{func.id_funcionario}} onclick="callform(this.id)">Editar</button>
                            <!--<a  class="btn btn-sm btn-info" href="#/f/{{func.id_funcionario}}">Editar</a>
                            <!--href='funcionario_form.php/f/{{func.id_funcionario}}/pf/{{func.id_pessoaFisica}}'-->
                            <!--href='funcionario_form.php?f={{func.id_funcionario}}&pf={{func.id_pessoaFisica}}'-->
                            <!--ng-click="openModalAddFuncionario('lg', item, $index)"-->
                            </td>
                        </tr>
                    </table>
                    <div ng-view></div>
                </div>
            </div>
        </div>
    </body>
</html>