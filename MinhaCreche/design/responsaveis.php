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
            
            function deleteResponsavel(id_reponsavel, id_pessoaFisica){
                // Validações decentes //
                if(confirm("Deseja excluir esse responsável?")){
                    $.post("../code/responsavelCRUD.php", 
                           {operacao : 5, id_responsavel: id_reponsavel, id_pessoaFisica: id_pessoaFisica }, function(retorno) {
                        var dado = JSON.parse(retorno);
                        if(dado == true){
                            loadPage();    
                        } else {
                            alert("Não foi possivel realizar a operação");
                        }
                        
                    });
                }
            }
            
            function loadPage() {
                $("#corpoTabela").empty();
                $.post("../code/responsavelCRUD.php", {operacao : 1}, function(retorno){
                    //alert(retorno);
                    var dados = JSON.parse(retorno);
                    for(var i=0;dados.length>i;i++){
                        $('#corpoTabela').append(
                            '<tr><td>' + dados[i].nome + '</td>' + 
                            '<td>' + dados[i].telefone + '</td>' + 
                            '<td>' + dados[i].celular + '</td>'+
                            '<td><button class="btn btn-sm btn-danger" onclick="deleteResponsavel(' + dados[i].id_responsavel+', ' + dados[i].id_pessoaFisica + ')">Excluir</button>' + 
                            '<button class="btn btn-sm btn-info" id=' + dados[i].id_responsavel + ' onclick="callform(this.id)">Editar</button></td></tr>');
			         }
                });
            }
            
            $(document).ready(function(e) {
                loadPage();
            });
            
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include '../code/valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space_title">Responsáveis <a href="responsavel_form.php"><img class="icon" src="img/plus-circle-outline.png" alt="Adicionar Resposável"></a></h1>
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