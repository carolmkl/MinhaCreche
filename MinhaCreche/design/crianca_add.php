<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <script src="js/callPage.js"></script>

    </head>
    <body>
        <div>
            <?php include '../code/valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space">Adicionar Criança</h1>
                <form action="" autocomplete="on" method="post">
                <div class="space">
                    <label class="text" for="name">Nome</label> <input class="text_big" type="text" id="name" name="name" autofocus> 
                    <label class="text" for="nascimento">Data de Nascimento</label> <input type="date" id="nascimento" name="nascimento" >
                    <br>
                    
                    <label class="text" for="celular">Gênero</label>
                    <select class="dropdown" for="genero" id="genero" name="genero" >
                            <option value="">Selecione</option>
                            <option value="masc">Mesculino</option>
                            <option value="fem">Feminino</option>
                    </select><br>
                    <label class="text" for="obsCrianca">Observação</label> <br>
                        <textarea  class="text" rows="10" cols="100" id="obsCrianca" name="obsCrianca" ></textarea>
                    <br>
                    <br>

                    <fieldset class="fieldset_border">
                        <legend>Responsáveis</legend>
                        <input list="responsaveis">
                          <datalist id="responsaveis">
                            <option value="Exemplo 1">
                            <option value="Exemplo 2">
                            <option value="Exemplo 3">
                            <option value="Exemplo 4">
                            <option value="Exemplo 5">
                          </datalist>
                        <button>Adicionar</button>
                    </fieldset>

                    <fieldset class="fieldset_border">
                        <legend>Endereço</legend>
                        <label class="text" for="logradouro">Logradouro</label> <input class="text_bigger" type="text" id="logradouro" name="logradouro" > 
                        <label class="text" for="num">Numero</label> <input class="text_small" type="number" id="num" name="num" ><br>
                        
                        <label class="text" for="bairro">Bairro</label> <input class="text_big" type="text" id="bairro" name="bairro" > 
                        <label class="text" for="city">Cidade</label> <input type="text" id="city" name="city" >
                        <label class="text" for="state">Estado</label> <input class="text_smaller" type="text" id="state" name="state" ><br>
                        
                        <label class="text" for="obs">Observação</label> 
                        <input class="text_bigger" type="text" id="obs" name="obs" ><br>
                        
                    </fieldset>

                </div>
                <p> <input id="bsubmit" type="button" value="Confirmar" /> <input type="button" value="Cancelar" onclick="goBack()"> </p>
                </form>
            </div>
        </div>
        <?php include 'import.php' ?>
    </body>
</html>