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
                <h1 class="space_title">Crianças <a href="crianca_add.php"><img class="icon" src="img/plus-circle-outline.png" alt="Adicionar Criança"></a></h1>
                <div class="space">
                    
                    <table>
                    
                    </table>

                </div>
            </div>
        </div>
        <?php include 'import.php' ?>
    </body>
</html>