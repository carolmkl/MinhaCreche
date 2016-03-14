<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">

    </head>
    <body>
        <div>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space">Cadastro de Funcionarios</h1>
                <div class="space">
                    <label class="text" for="foto">Foto</label> <input class="text_big" type="text" id="browse" name="browse" disabled> <input type="button" value="Browse..."> <br> 
                    <label class="text" for="name">Nome</label> <input class="text_big" type="text" id="name" name="name" disabled><br>
                    <label class="text" for="cpf">CPF</label> <input class="text_small" type="text" id="cpf" name="cpf" disabled><br>
                    <label class="text" for="email">E-mail</label> <input class="text_big" type="text" id="email" name="email" disabled><br>
                    <label class="text" for="profissao">Profissão</label> <input class="text_small" type="text" id="profissao" name="profissao" disabled><br>
                    <label class="text" for="dtNasc">Data Nascimento</label> <input class="text_small" type="text" id="dtNasc" name="dtNasc" disabled><br>
                    
                    <fieldset class="widht">
                    <legend>Gênero</legend>
                    <input type="radio" name="gender" id="male" checked="checked" />Masculino<br/>
                    <input type="radio" name="gender" id="female" />Feminino<br/>
                    </fieldset>
                    
                    <label class="text" for="celular">Celular</label> <input class="text_small" type="text" id="celular" name="celular" disabled><br>
                    <label class="text" for="foneRes">Fone Residencial</label> <input class="text_small" type="text" id="foneRes" name="foneRes" disabled><br>
                    <label class="text" for="foneCom">Fone Comercial</label> <input class="text_small" type="text" id="foneCom" name="foneCom" disabled><br>
                    
                    <label class="text" for="login">Login</label> <input class="text_small" type="text" id="login" name="login" disabled><br>
                    <label class="text" for="senha">Senha</label> <input class="text_small" type="text" id="senha" name="senha" disabled><br>
                    <label class="text" for="nivel">Nivel de Acesso</label> <br>
                    
                    <p> <input id="bsubmit" type="submit" value="Confirmar" /> <input type="button" value="Cancelar"> </p>
                </div>
            </div>
        </div>
    </body>
</html>