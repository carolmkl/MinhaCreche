<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <script src="js/vadilacoes.js"></script>
        <?php include '../code/valida_user.php' ?>
        <?php include 'import.php' ?>
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
                        var dados = JSON.parse(retorno);
                        console.log(retorno);
                        
                       $("#nome").val(dados[0].nome);
                        $("#dtNascimento").val(dados[0].dtNascimento);
                        $("#genero").val(dados[0].genero);
                        $("#observacao").val(dados[0].obs);
                        $("#idCrianca").val(dados[0].id_crianca);
                        
                    });
                }
                
                
                
            });        
            
        </script>

    </head>
    <body>
        <div>
            <?php include 'menu_principal.php';
                $f = 0;
                if(isset($_REQUEST["id"])){
                    $f = $_REQUEST["id"];
                }
            ?>

            <div class="conteiner">
                <form action="" autocomplete="on" method="post" id="form" >
                    <?php
                        if($f == 0){
                            echo "<h1 class='space'>Adicionar Criança</h1>";
                        } else {
                            echo "<h1 class='space'>Editar Criança</h1>";
                        }
                    ?>
                    <input type="hidden" id="idCrianca" value="<?php echo $f; ?>">
                    <div class="space">
                        <fieldset class="fieldset_border">
                            <legend>Dados da Criança</legend>
                            <label class="text" for="nome">Nome</label> <input class="text_big" type="text" id="nome" name="nome" autofocus><br>
                            <label class="text" for="dtNascimento">Data de Nascimento</label> <input type="date" id="dtNascimento" name="nascimento">
                            <br>

                            <label class="text" for="genero">Gênero</label>
                            <select class="dropdown" id="genero" name="genero" >
                                <option value="">Selecione</option>
                                <option value="M">Masculino</option>
                                <option value="F">Feminino</option>
                            </select><br>
                            <br>
                            <label class="text" for="observacao">Observação</label> <br>
                            <textarea  class="text" rows="10" cols="100" id="observacao" name="observacao" ></textarea>
                        </fieldset>
                        <br>
                        <br>

                        <fieldset class="fieldset_border">
                            <legend>Responsáveis</legend>
                            <label for="responsaveis">Responsável</label>
                            <select class="dropdown" id="responsaveis" name="responsaveis" >
                            </select>
                            <br>
                            <label for="parentesco">Parentesco</label>
                            <input class="text" type="text" id="parentesco">
                            <button type="button" id="adicionarResponsavel">Adicionar</button>
                            <br>
                            <!--melhorar a tabela-->
                            <table>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th></th>
                                </tr>
                                <tbody table id="corpoTabela">
                                </tbody>
                            </table>
                            <br>
                        </fieldset>

                        <p> 
                            <input id="submit" type="button" value="Confirmar" />
                            <input type="button" value="Cancelar" onclick="goBack()">
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>