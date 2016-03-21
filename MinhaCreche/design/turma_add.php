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
                <h1 class="space">Adicionar Turma</h1>
                <form action="" autocomplete="on" method="post">
                <div class="space">
                    <label class="text" for="apelido">Apelido</label> <input class="text_big" type="text" id="sala" name="apelido" autofocus> 
                    <label class="text" for="sala">Sala</label> <input class="text_small" type="text" id="sala" name="sala" >
                    <label class="text" for="descricao">Descricao</label> <input class="text_small" type="text" id="descricao" name="descricao" ><br>                    

                    <label class="text" for="hrInicio">Hora Inicio</label> <input type="text" id="hrInicio" name="hrInicio" >
                    <label class="text" for="hrFim">Hora Fim</label> <input type="text" id="hrFim" name="hrFim" ><br>
                    <br>
                </div>
                <p> <input id="bsubmit" type="button" value="Confirmar" /> <input type="button" value="Cancelar" onclick="goBack()"> </p>
                </form>
            </div>
        </div>
    </body>
</html>