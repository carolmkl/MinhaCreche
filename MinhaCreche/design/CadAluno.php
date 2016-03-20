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
            <?php include 'valida_user.php' ?>
            <?php include 'menu_principal.php' ?>

            <div class="conteiner">
                <h1 class="space">Cadastro de Alunos</h1>
                <div class="space">
                    <label class="text" for="name">Nome</label> <input class="text_big" type="text" id="name" name="name" disabled><br> 
                    <label class="text" for="dtNasc">Data Nascimento</label> <input class="text_small" type="text" id="dtNasc" name="dtNasc" disabled><br>
                    
                    <fieldset class="widht">
                    <legend>Gênero</legend>
                    <input type="radio" name="gender" id="male" checked="checked" />Masculino<br/>
                    <input type="radio" name="gender" id="female" />Feminino<br/>
                    </fieldset>                  
                    
                    <fieldset class="width">
                        <legend>Responsavel</legend>
                        <label class="text" for="nameRes">Nome</label> <input class="text_big" type="text" id="nameRes" name="nameRes" disabled> <input type="button" value="Consultar" /> <br>                        
                        <label class="text" for="parentesco">Parentesco</label> <input class="text" type="text" id="parentesco" name="parentesco" disabled><br>
                        <input type="button" value="Adicionar" /> <input type="button" value="remover">
                        <table border=1 bgcolor='yellow'>
                            <tr> <td>Nome</td> <td bgcolor='#aaddbb'>Parentesco</td> </tr>
                            
                        </table>
                    </fieldset><br>    

                    <label class="text" for="nescEspeciais">Necessidades Especiais</label> <textarea name="textarea" rows=6 cols=30 ></textarea><br>
                    
                    <table>
                    
                    </table>
                    
                    <p> <input id="bsubmit" type="submit" value="Confirmar" /> <input type="button" value="Cancelar"> </p>
                </div>
            </div>
        </div>
    </body>
</html>