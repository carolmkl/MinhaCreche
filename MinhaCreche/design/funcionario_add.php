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
            <?php include 'valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space">Adicionar Funcionário</h1>
                <form action="" autocomplete="on" method="post">
                <div class="space">
                    <label class="text" for="name">Nome</label> <input class="text_big" type="text" id="name" name="name" autofocus> 
                    <label class="text" for="rg">RG</label> <input class="text_small" type="text" id="rg" name="rg" >
                    <label class="text" for="cpf">CPF</label> <input class="text_small" type="text" id="cpf" name="cpf" ><br>
                    

                    <label class="text" for="mail">E-mail</label> <input class="text_bigger" type="email" id="mail" name="mail" ><br>

                    <label class="text" for="telefone">Telefone</label> <input type="tel" id="telefone" name="telefone" >
                    <label class="text" for="celular">celular</label> <input type="tel" id="celular" name="celular" ><br>
                    <label class="text" for="nascimento">Data de Nascimento</label> <input type="date" id="nascimento" name="nascimento" >
                    <label class="text" for="celular">Gênero</label>
                    <select class="dropdown" for="genero" id="genero" name="genero" >
                            <option value="">Selecione</option>
                            <option value="masc">Masculino</option>
                            <option value="fem">Feminino</option>
                    </select>
                    <br>
                    <br>

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

                    <label class="text" for="perfil">Perfil</label>
                    <select class="dropdown" for="perfil" id="perfil" name="perfil" >
                            <option value="">Selecione</option>
                            <option value="diretor">Diretor</option>
                            <option value="secretario">Secretário</option>
                            <option value="professor">Professor</option>
                    </select>

                </div>
                <p> <input id="bsubmit" type="button" value="Confirmar" /> <input type="button" value="Cancelar" onclick="goBack()"> </p>
                </form>
            </div>
        </div>
    </body>
</html>