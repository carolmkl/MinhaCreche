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
        <?php include '../code/valida_user.php'; ?>
        <?php include 'import.php' ?>
        
        <script type="text/javascript">
            function callform(id,ver) {
                window.location = "avisos_form.php?id="+id+"&visualizar="+ver;
            }
            
            // aviso é que nem email
            
            function deleteAviso(id_aviso){
                // Validações decentes //
                if(confirm("Deseja excluir este aviso?")){
                    $.post("../code/avisoCRUD.php", 
                           {operacao : 5, id_aviso: id_aviso }, function(retorno) {
                        var dado = JSON.parse(retorno);
                        if(dado == true){
                            loadPage();    
                        } else {
                            alert("Não foi possivel realizar a operação");
                        }
                        
                    });
                }
            }
            
            function deleteViewAviso(id_aviso){
                // Validações decentes //
                if(confirm("Deseja excluir este aviso?")){
                    $.post("../code/avisoCRUD.php", 
                           {operacao : 10, id_aviso: id_aviso }, function(retorno) {
                        var dado = JSON.parse(retorno);
                        if(dado == true){
                            loadPage();    
                        } else {
                            alert("Não foi possivel realizar a operação");
                        }
                    });
                }
            }
            
            function convetSqlDateIntoNormalDateString(sqlDate){
                arraySqlDate = sqlDate.split("-");
                return arraySqlDate[2] + "/" + arraySqlDate[1] + "/" + arraySqlDate[0];
            }
			
			function informaNivel(nivel){
				switch(nivel){
					case '1':	
						return "IMPONTANTE";
						break;
					case '2':	
						return "MEDIO";
						break;
					case '3':	
						return "NORMAL";
						break;
				} 
			}
            
            function loadDados(dados,local){
                var vId_pessoaFisica = Number($("#idPessoa").val())
                var classe;
                for(var i=0;dados.length>i;i++){
                    classe = "";
                    if(dados[i].dtLido == null){
                        classe = "class='bg-primary'";
                    }
                    
                    $(local).append(
                        '<tr ' + classe + '><td>' + dados[i].nome + '</td>' + 
                        '<td>' + convetSqlDateIntoNormalDateString(dados[i].dataEntrega) + '</td>' + 
						'<td>' + informaNivel(dados[i].nivel) + '</td>' + 
                        '<td><button class="btn btn-sm btn-danger" onclick="deleteViewAviso(' + dados[i].id_Aviso + ',' + vId_pessoaFisica +')">Excluir</button>' + 
                        '<button class="btn btn-sm btn-info" id=' + dados[i].id_Aviso + ' onclick="callform(this.id,true)">Ver</button></td></tr>');
			         }
            }
            
            function loadDadosNaoEnviado(dados,local){
                for(var i=0;dados.length>i;i++){
                    
                    $(local).append(
                        '<tr><td>' + dados[i].nome + '</td>' + 
                        '<td>' + convetSqlDateIntoNormalDateString(dados[i].dataEntrega) + '</td>' + 
                        '<td><button class="btn btn-sm btn-danger" onclick="deleteAviso(' + dados[i].id_Aviso + ')">Excluir</button>' + 
                        '<button class="btn btn-sm btn-info" id=' + dados[i].id_Aviso + ' onclick="callform(this.id,false)">Editar</button></td></tr>');
			         }
            }
            
            function loadPage() {
//                $("#avisoImportante").empty();
//                $("#avisoMedio").empty();
//                $("#avisoNormal").empty();
				$("#avisoRecebidos").empty();
                $("#avisoNFoi").empty();
                var vId_pessoaFisica = Number($("#idPessoa").val());
                $.post("../code/avisoCRUD.php", {operacao : 1, nivelAviso: 1, id_pessoaFisica: vId_pessoaFisica}, function(retorno){
                    var dados = JSON.parse(retorno);
                    loadDados(dados,"#avisoRecebidos");
                });
                $.post("../code/avisoCRUD.php", {operacao : 1, nivelAviso: 2, id_pessoaFisica: vId_pessoaFisica}, function(retorno){
                    var dados = JSON.parse(retorno);
                    loadDados(dados,"#avisoMedio");
                });
                $.post("../code/avisoCRUD.php", {operacao : 1, nivelAviso: 3, id_pessoaFisica: vId_pessoaFisica}, function(retorno){
                    var dados = JSON.parse(retorno);
                    loadDados(dados,"#avisoNormal");
                });
                $.post("../code/avisoCRUD.php", {operacao : 1, nivelAviso: 4, id_pessoaFisica: vId_pessoaFisica}, function(retorno){
                    var dados = JSON.parse(retorno);
                    loadDadosNaoEnviado(dados,"#avisoNFoi");
                });
            }
            
            $(document).ready(function(e) {
                loadPage();
            });
            
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include 'menu_principal.php'; 
                $idpessoa = $_SESSION['mc_pessoa_id'];
            ?>

            <div class="conteiner">
                <h1 class="space_title">Avisos <a href="avisos_form.php"><img class="icon" src="img/plus-circle-outline.png" alt="Adicionar Aviso"></a><img class="icon" src="img/ic_print_black_24dp_2x.png"></h1>
                
                <input type="hidden" id="idPessoa" value="<?php echo $idpessoa; ?>">
                <div class="spacee">
                    <!--<fieldset>
                        <legend>Importante</legend>
                        <table>
                            <tr>
                                <th>Remetente</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                            <tbody id="avisoImportante">
                            </tbody>
                        </table>
                    </fieldset>    
                    
                    <br>
                    
                    <fieldset>
                        <legend>Médio</legend>
                        <table>
                            <tr>
                                <th>Remetente</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                            <tbody id="avisoMedio">
                            </tbody>
                        </table>
                    </fieldset>    
                    
                    <br>
                    
                    <fieldset>
                        <legend>Normal</legend>
                        <table>
                            <tr>
                                <th>Remetente</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                            <tbody id="avisoNormal">
                            </tbody>
                        </table>
                    </fieldset> -->
					
					<fieldset>
                        <legend>Recebidos</legend>
                        <table>
                            <tr>
                                <th>Remetente</th>
                                <th>Data</th>
								<th>Importancia</th>
                                <th></th>
                            </tr>
                            <tbody id="avisoRecebidos">
                            </tbody>
                        </table>
                    </fieldset>
                    
                    <br>
                    
                    <fieldset>
                        <legend>Agendados para Entrega</legend>
                        <table>
                            <tr>
                                <th>Sobre</th>
                                <th>Data de Envio</th>
                                <th></th>
                            </tr>
                            <tbody id="avisoNFoi">
                            </tbody>
                        </table>
                    </fieldset>    
                </div>
            </div>
        </div>
    </body>
</html>