<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <script src="js/vadilacoes.js"></script>
        <?php include '../code/valida_user.php' ?>
        <?php include 'import.php' ?>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/callPage.js"></script>
        
        <script type="text/javascript">
            // variavel global para os responsáveis
            var dados = [];
            var arrayResponsavel = [];
            
            // método pra colocar os responsáveis em uma tag select
            function loadResponsaveis() {
                $("#responsaveis").empty();
                $.post("../code/responsavelCRUD.php", {operacao : 1}, function(retorno){
                    //alert(retorno);
                    dados = JSON.parse(retorno);
                    $('#responsaveis').append(
                            '<option value="">Selecione</option>');
                    for(var i=0;dados.length>i;i++){
                        $('#responsaveis').append(
                            '<option value=' + i + '>' + dados[i].nome + '</option>');
			         }
                });
            }
            
            // preenche a tabela com o responsavel escolhido
            function preencheTabela(){
                $('#corpoTabela').empty();
                for(var i=0;i < arrayResponsavel.length;i++){
                    $('#corpoTabela').append(
                        '<tr><td>' + dados[arrayResponsavel[i].indice].nome + '</td>' +
                        '<td>' + dados[arrayResponsavel[i].indice].cpf + '</td>' +
                        '<td>' + arrayResponsavel[i].parentesco + '</td>' +
                        '<td><button type="button" class="btn btn-sm btn-danger" onclick="deleteResponsavel(' + i + ')">Excluir</button></td></tr>');
			         }
            }
            
            // deleta um responsavel
            function deleteResponsavel(indice){
                arrayResponsavel.splice(indice,1);
                preencheTabela();
            }
            
            //documento pronto
            $(document).ready(function() {
                loadResponsaveis();
                
                var vIdCrianca = Number($("#idCrianca").val());
                $("#submit").click(function (e) {
                    var vNome = $("#nome").val(),
                        vDtNascimento = $("#dtNascimento").val(), 
                        vGenero = $("#genero").val(), 
                        vObservacao = $("#observacao").val();
                    
                    var vOpcao;
                    if(vIdCrianca != 0 ){
                        vOpcao = 4;
                    } else {
                        vOpcao = 3;
                    }
                    
                    var erros = [];
                    
                    if(!validaNome(vNome)){
                        erros[erros.length] = "Nome inválido. Somente letras e números de tamanho mínimo 3."
                        $("#nome").css("border-color", "red");
                    }
                    if(vDtNascimento == ""){
                        erros[erros.length] = "Data de nascimento inválida. Informe uma data."
                        $("#dtNascimento").css("border-color", "red");
                    }
                    if(vGenero == ""){
                        erros[erros.length] = "Selecione o Gênero."
                    }
                    if(vObservacao != "" && !validaNome(vObservacao)){
                        erros[erros.length] = "Observação inválida. Somente letras e números de tamanho mínimo 3."
                        $("#observacao").css("border-color", "red");
                    }
                    if(arrayResponsavel.length == 0){
                        erros[erros.length] = "Adicione algum responsavel."
                    }
                    
                    if(erros.length == 0){
                            $.post("../code/criancaCRUD.php", {
                            operacao: vOpcao,    
                            id_crianca : vIdCrianca,
                            nome : vNome,
                            dtNascimento : vDtNascimento,
                            genero : vGenero,
                            observacao : vObservacao,
                            responsaveis: JSON.stringify(arrayResponsavel)
                        }, function (retorno) {
                            console.log(retorno);
                            var dadosRetorno = JSON.parse(retorno);
                            console.log(dadosRetorno);
                            if (dadosRetorno == true) {
                                window.location.replace("criancas.php");
                            } else {
                                alert("Ocorreu um erro inesperado ao realizar a operação!");
                            }
                        });
                    } else {
                        var msg = "Corrija estes erros:";
                        for (var i = 0; i<erros.length; i++) {
                            msg += "\n" + erros[i];
                        }
                        alert(msg);
                    }
                    
                });
                
                $("#adicionarResponsavel").click(function(e) {
                    var vResponsavel = $("#responsaveis").val(),
                        vParentesco = $("#parentesco").val();
                    var erros = [];
                    if(vResponsavel == ""){
                        erros[erros.length] = "Selecione o Responsável."
                    }
                    if(!validaNome(vParentesco)){
                        erros[erros.length] = "Parentesco inválida. Somente letras e números de tamanho mínimo 3."
                    }
                    
                    if(erros.length == 0) {
                        var indice = Number(vResponsavel);
                        var responsavel = {indice: indice, id: dados[indice].id_responsavel, parentesco: vParentesco};
                        arrayResponsavel[arrayResponsavel.length] = responsavel;
                        preencheTabela();
                        $("#responsaveis").val("");
                        $("#parentesco").val("");
                    } else {
                        var msg = "Corrija estes erros:";
                        for (var i = 0; i<erros.length; i++) {
                            msg += "\n" + erros[i];
                        }
                        alert(msg);
                    }
                });
                
                if(vIdCrianca != 0){
                    $.post("../code/criancaCRUD.php", {operacao : 2, id_crianca: vIdCrianca}, function (retorno) {
                        var dadosC = JSON.parse(retorno);
                        //console.log(retorno);
                        
                       $("#nome").val(dadosC[0].nome);
                        $("#dtNascimento").val(dadosC[0].dtNascimento);
                        $("#genero").val(dadosC[0].genero);
                        $("#observacao").val(dadosC[0].obs);
                        $("#idCrianca").val(dadosC[0].id_crianca);
                        
                        $.post("../code/criancaCRUD.php", {operacao : 6, id_crianca: vIdCrianca}, function (retorno) {
                            var reponsaveis = JSON.parse(retorno);
                            console.log(reponsaveis);
                            console.log(dados);
                            for(i = 0; i<reponsaveis.length; i++){
                                for(j=0; j<dados.length;j++){
                                    if(Number(dados[j].id_responsavel) == Number(reponsaveis[i].id_responsavel)){
                                        var responsavel = {indice: j, id: dados[j].id_responsavel, parentesco: reponsaveis[i].parentesco};
                                        arrayResponsavel[arrayResponsavel.length] = responsavel;
                                        j = dados.length;
                                    }
                                }
                            }
                            preencheTabela();
                        });
                        
                    });
                }
                
                
                
            });        
            
        </script>

    </head>
    <body>
        <div class="container-fluid">
            <?php include 'menu_principal.php';
                $f = 0;
                if(isset($_REQUEST["id"])){
                    $f = $_REQUEST["id"];
                }
            ?>

            <div class="conteiner">
                <form action="" autocomplete="on" method="post" id="form" role="form">
                    <?php
                        if($f == 0){
                            echo "<h1 class='space'>Adicionar Criança</h1>";
                        } else {
                            echo "<h1 class='space'>Editar Criança</h1>";
                        }
                    ?>
                    <input type="hidden" id="idCrianca" value="<?php echo $f; ?>">
                    <div class="spacee">
                        <fieldset>
                            <legend>Dados da Criança</legend>
                            <div class="form-group">
                                <label for="nome">Nome<sup>*</sup></label> 
                                <input class="form-control" type="text" id="nome" name="nome" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="dtNascimento">Data de Nascimento<sup>*</sup></label> 
                                <input class="form-control" type="date" id="dtNascimento" name="nascimento">
                            </div>

                            <div class="form-group">
                                <label for="genero">Gênero<sup>*</sup></label>
                                <select class="dropdown form-control" id="genero" name="genero" >
                                    <option value="">Selecione</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                            </div> 
                            
                            <div class="form-group">
                                <label for="observacao">Observação</label> <br>
                                <textarea  class="form-control" rows="10" cols="100" id="observacao" name="observacao" ></textarea>
                            </div>
                            
                        </fieldset>
                        <br>

                        <fieldset>
                            <legend>Responsáveis<sup>*</sup></legend>
                            <div class="form-group">
                                <label for="responsaveis">Responsável</label>
                                <select class="dropdown form-control" id="responsaveis" name="responsaveis" >
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="parentesco">Parentesco</label>
                                <input class="form-control" type="text" id="parentesco">
                            </div>    
                            <button type="button" id="adicionarResponsavel">Adicionar</button>
                            <br>
                            <br>
                            <table>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Parentesco</th>
                                    <th></th>
                                </tr>
                                <tbody table id="corpoTabela">
                                </tbody>
                            </table>
                        </fieldset>
                        
                        <br>
                        <p id="obrigatorio"><sup>*</sup> Campos obrigatórios</p>
                        <br>
                        
                        <p> 
                            <input class="btn btn-success" id="submit" type="button" value="Confirmar" />
                            <input class="btn btn-danger" type="button" value="Cancelar" onclick="goBack('criancas.php')">
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>