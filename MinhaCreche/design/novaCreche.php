<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Minha Creche</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_menu3.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_conteudo.css" type="text/css">
        <link rel="stylesheet" href="css/estilo_imagem.css" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <?php include 'import.php' ?>

    </head>
    <body>
        <div class="container-fluid">
            <div class="center-block">
                <h1>Dados da Creche</h1>
                <div class="center-block">
                    <form method="post" action="diretorCad.php" role="form">
                        <div class="form-group">
                            <label class="text" for="nomeC">Nome</label>
                            <input class="form-control" type="text" id="nomeC">
                        </div>
                        <div class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <input class="form-control" type="text" id="cnpj" >
                        </div>
                        <div class="form-group">
                            <label for="emailC">E-mail</label>
                            <input class="form-control" type="email" id="emailC">
                        </div>
                        <div class="form-group">
                            <label for="telefone1C">Telefone 1</label>
                            <input class="form-control" type="text" id="telefone1C">
                        </div>
                        <div class="form-group">
                            <label for="telefone2">Telefone 2</label>
                            <input  class="form-control"type="text" id="telefone2C">
                        </div>
                        
                        <br>
                        
                        <fieldset>
                            <legend>Endereço</legend>
                            <div class="row">
                                <div  class="form-group col-md-9">
                                    <label for="logradouroC">Logradouro</label>
                                    <input class="form-control" type="text" id="logradouroC"> 
                                </div>
                                <div  class="form-group col-md-3">
                                    <label for="numeroC">Numero</label>
                                    <input class="form-control" type="text" id="numeroC">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div  class="form-group col-md-6">
                                    <label for="bairroC">Bairro</label>
                                    <input class="form-control" type="text" id="bairroC"> 
                                </div>
                                <div  class="form-group col-md-4">
                                    <label for="cidadeC">Cidade</label>
                                    <input class="form-control" type="text" id="cidadeC">
                                </div>
                                <div  class="form-group col-md-2">
                                    <label for="estadoC">Estado</label>
                                    <input class="form-control" type="text" id="estadoC">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="observacaoC">Observação</label>
                                <textarea class="form-control" id="observacaoC"></textarea>
                            </div>
                        </fieldset>
                        
                        <br><br>

                        <p>
                            <input class='btn btn-success' id='bsubmit'' type='submit'' value='Proximo' />
                            <input class='btn btn-danger' type='button' value='Cancelar' onclick='goBack();'>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>