<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>

    </head>
    <body>
        <div>
            <?php include '../code/valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space">Dados da Creche</h1>
                <div class="space">
                    <label class="text" for="name">Nome</label> <input class="text_big" type="text" id="name" name="name" disabled> 
                    <label class="text" for="cnpj">CNPJ</label> <input class="text_small" type="text" id="cnpj" name="cnpj" disabled><br>
                    

                    <label class="text" for="mail">E-mail</label> <input class="text_bigger" type="text" id="mail" name="mail" disabled><br>

                    <label class="text" for="phone1">Telefone 1</label> <input type="text" id="phone1" name="phone1" disabled><br>
                    <label class="text" for="phone2">Telefone 2</label> <input type="text" id="phone2" name="phone2" disabled><br>

                    <fieldset class="fieldset_border">
                        <legend>Endereço</legend>
                        <label class="text" for="logradouro">Logradouro</label> <input class="text_bigger" type="text" id="logradouro" name="logradouro" disabled> 
                        <label class="text" for="num">Numero</label> <input class="text_small" type="text" id="num" name="num" disabled><br>
                        
                        <label class="text" for="bairro">Bairro</label> <input class="text_big" type="text" id="bairro" name="bairro" disabled> 
                        <label class="text" for="city">Cidade</label> <input type="text" id="city" name="city" disabled>
                        <label class="text" for="state">Estado</label> <input class="text_smaller" type="text" id="state" name="state" disabled><br>
                        
                        <label class="text" for="obs">Observação</label><br> 
                        <input class="text_bigger" type="text" id="obs" name="obs" disabled><br>
                        
                    </fieldset>

                </div>
            </div>
        </div>
    </body>
</html>