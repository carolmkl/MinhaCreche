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
                <h1 class="space">Crianças</h1>
                <div class="space">
                    <label class="text" for="name">Nome</label> <input class="text_big" type="text" id="name" name="name" disabled> 
                    <label class="text" for="genero">Genero</label> <input class="text_small" type="text" id="genero" name="genero" disabled><br>
                    
                    <label class="text" for="dtNasc">Data Nascimento</label> <input class="text" type="text" id="dtNasc" name="dtNasc" disabled><br>

                    <label class="text" for="nescEspeciais">Necessidades Especiais</label> <input type="text" id="nescEspeciais" name="nescEspeciais" disabled><br>
                    
                    <table>
                    
                    </table>

                </div>
            </div>
        </div>
    </body>
</html>