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
                window.location = "responsavel_form.php?id="+id;
            }
            
            $(document).ready(function(e) {
                $("#corpoTabela").empty();
                $.post("../code/responsavelCRUD.php", {operacao : 1}, function(retorno){
                    //alert(retorno);
                    var dados = JSON.parse(retorno);
                    for(var i=0;dados.length>i;i++){
				        //Adicionando registros retornados na tabela
                        /*
                            <td>{{ func.cargo }}</td>
                            <td>{{ func.nome }}</td>
                            <td>{{ func.celular }}</td>
                            <td><a ng:click="deleteFuncionario(func.id_funcionario, func.id_pessoaFisica)" class="btn btn-sm btn-danger">Excluir</a>
                            <button class="btn btn-sm btn-info" id={{func.id_funcionario}} onclick="callform(this.id)">Editar</button>
                            </td>
                        */
                        $('#corpoTabela').append(
                            '<tr><td>' + dados[i].nome + '</td>' + 
                            '<td>' + dados[i].telefone + '</td>' + 
                            '<td>' + dados[i].celular + '</td>'+
                            '<td><a ng:click="deleteFuncionario(func.id_funcionario, func.id_pessoaFisica)" class="btn btn-sm btn-danger">Excluir</a>'+
                            '<button class="btn btn-sm btn-info" id=' + dados[i].id_responsavel + ' onclick="callform(this.id)">Editar</button></td></tr>');
			         }
                });
            });
            
        </script>
    </head>
    <body>
        <div>
            <?php include '../code/valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space_title">Responsáveis <a href="responsavel_add.php"><img class="icon" src="img/plus-circle-outline.png" alt="Adicionar Resposável"></a></h1>
                <div class="space">
                    
                    <table>
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th></th>
                        </tr>
                        <tbody table id="corpoTabela">
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </body>
</html>