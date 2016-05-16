<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include '../code/valida_user.php' ?>
        
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <script src="js/callPage.js"></script>
        <?php include 'import.php' ?>
        
        <script type="text/javascript">
        </script>

    </head>
    <body>
        <div class="container-fluid">
            
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space">Dados do Usuário</h1>
                <div class="spacee">
                    <form role="form" >
                        <input type="hidden" id="id_pessoa">
                         <fieldset>
                            <legend>Acesso ao Sistema</legend>
                            <div class="form-group">
                                <label class="text" for="login">Login</label>
                                <input class="form-control" type="text" id="login" value=<?php echo $_SESSION['mclogin']?>>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input class="form-control" type="password" id="senha" >
                            </div>
                        </fieldset>
                        
                        <br>
                        
                        <fieldset>
                            <legend>Nível de Acesso</legend>
                            <div class="form-group">
                                <label for="nivel">Nível</label>
                                <input class="form-control" type="text" id="nivel" value=<?php echo $_SESSION['mc_user_nivel']?> disabled>
                            </div>
                        </fieldset>
                        
                        <br><br>

                        <p>
                            <input class='btn btn-success' id='bsubmit' type='submit' value='Salvar' />
                            <input class='btn btn-danger' type='button' value='Cancelar' onclick='goBack("home.php");'>    
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>