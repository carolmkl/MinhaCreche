<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <script src="js/callPage.js"></script>
        <?php include 'import.php' ?>

        <script type="text/javascript">
            function callform(id) {
                window.location = "crianca_form.php?id="+id;
            }
            
            function deleteCrianca(id_crianca){
                // Validações decentes //
                if(confirm("Deseja excluir essa criança?")){
                    $.post("../code/criancaCRUD.php", 
                           {operacao : 5, id_crianca: id_crianca }, function(retorno) {
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
                $.post("../code/criancaCRUD.php", {operacao : 1}, function(retorno){
                    var dados = JSON.parse(retorno);
                    for(var i=0;dados.length>i;i++){
                        $('#corpoTabela').append(
                            '<tr><td>' + dados[i].nome + '</td>' + 
                            //'<td>' + dados[i].telefone + '</td>' + 
                            //'<td>' + dados[i].celular + '</td>'+
                            '<td><button class="btn btn-sm btn-danger" onclick="deleteCrianca(' + dados[i].id_crianca + ')">Excluir</button>' + 
                            '<button class="btn btn-sm btn-info" id=' + dados[i].id_crianca + ' onclick="callform(this.id)">Editar</button></td></tr>');
			         }
                });
            }
            
            $(document).ready(function(e) {
                loadPage();
            });
            
        </script>
    </head>
    <body>
        <div>
            <?php include '../code/valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space_title">Crianças <a href="crianca_form.php"><img class="icon" src="img/plus-circle-outline.png" alt="Adicionar Criança"></a></h1>
                <div class="space">
                    
                   <table>
                        <tr>
                            <th>Nome</th>
                            <!--<th>Telefone</th>
                            <th>Celular</th>-->
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