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
                <h1 class="space_title">Avisos <a href="#"><img class="icon" src="img/plus-circle-outline.png" alt="Adicionar Aviso"></a></h1>
                
                <div class="space div_table">
                    <table>
                        <tr>
                            <th>Importante</th>
                        </tr>
                        <tr>
                            <td>Algo</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th>Médio</th>
                        </tr>
                        <tr>
                            <td>Algo</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th>Normal</th>
                        </tr>
                        <tr>
                            <td>algo</td>
                        </tr>
                    </table>
                </div>
                
            </div>
        </div>
        <?php include 'import.php' ?>
    </body>
</html>