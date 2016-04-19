<?php 
    require_once 'conexaodb.php'; // The mysql database connection script
    
    function responsavelList(){
        
        $sql="select r.id_responsavel, r.id_pessoaFisica, r.profissao, pf.nome, pf.celular, pf.telefone from minhacreche.responsavel r inner join pessoafisica pf on r.id_pessoaFisica = pf.id_pessoafisica;";
        $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);

        $arr = array();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $arr[] = $row;	
            }
        }

        # JSON-encode the response
        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($arr);
    }

    function responsavelGet(){
        $id_responsavel = $_REQUEST['id_responsavel'];

        $sql="select r.id_responsavel, r.profissao, r.foneComercial, pf.*, u.login, u.senha from minhacreche.responsavel r inner join pessoafisica pf on r.id_pessoaFisica = pf.id_pessoafisica inner join usuario u on u.id_pessoafisica = pf.id_pessoafisica where r.id_responsavel = $id_responsavel;";

        //echo $sql;

        $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);

        $arr = array();
        if($result->num_rows > 0) {
            $arr[] = $result->fetch_assoc();
        }
        mysqli_close($GLOBALS['conn']);
        # JSON-encode the response
        echo $json_response = json_encode($arr);
    }

    function responsavelInsert(){
        $id_responsavel = $_REQUEST['id_responsavel'];
        $id_pessoafisica = $_REQUEST['id_pessoafisica'];
        $nome = strtoupper($_REQUEST['nome']);
        $cpf = $_REQUEST['cpf'];
        $rg = $_REQUEST['rg'];
        $email = $_REQUEST['email'];
        $telefone = $_REQUEST['telefone'];
        $telefoneCom = $_REQUEST['telefoneCom'];
        $celular = $_REQUEST['celular'];
        $dtNascimento = $_REQUEST['dtNascimento'];
        $genero = $_REQUEST['genero'];
        $logradouro = strtoupper($_REQUEST['logradouro']);
        $numero = $_REQUEST['numero'];
        $bairro = strtoupper($_REQUEST['bairro']);
        $cidade = strtoupper($_REQUEST['cidade']);
        $estado = strtoupper($_REQUEST['estado']);
        $observacao = strtoupper($_REQUEST['observacao']);
        $profissao = strtoupper($_REQUEST['profissao']);
        $login = $_REQUEST['login'];
        $senha = $_REQUEST['senha'];

        $senha = password_hash($senha, PASSWORD_BCRYPT);


        $sql = "INSERT INTO  pessoafisica  (nome,cpf,rg,email,telefone,celular,dtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao) VALUES ('$nome','$cpf','$rg','$email','$telefone','$celular','$dtNascimento','$genero','$logradouro','$numero','$bairro','$cidade','$estado','$observacao');
        SELECT @pf:=max(id_pessoaFisica) FROM pessoafisica;

        INSERT INTO usuario (id_PessoaFisica, login, senha, nivel) VALUES (@pf, '$login', '$senha', 'Responsavel');

        INSERT INTO responsavel (id_pessoaFisica, profissao, foneComercial) VALUES (@pf, '$profissao', '$telefoneCom');";
        //print $sql;
        $result = $GLOBALS['conn']->multi_query($sql) or die($GLOBALS['conn']->error.__LINE__);
        //echo $result;
        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($result);
    }

    function responsavelUpdate(){
        $id_responsavel = $_REQUEST['id_responsavel'];
        $id_pessoafisica = $_REQUEST['id_pessoafisica'];
        $nome = strtoupper($_REQUEST['nome']);
        $cpf = $_REQUEST['cpf'];
        $rg = $_REQUEST['rg'];
        $email = $_REQUEST['email'];
        $telefone = $_REQUEST['telefone'];
        $telefoneCom = $_REQUEST['telefoneCom'];
        $celular = $_REQUEST['celular'];
        $dtNascimento = $_REQUEST['dtNascimento'];
        $genero = $_REQUEST['genero'];
        $logradouro = strtoupper($_REQUEST['logradouro']);
        $numero = $_REQUEST['numero'];
        $bairro = strtoupper($_REQUEST['bairro']);
        $cidade = strtoupper($_REQUEST['cidade']);
        $estado = strtoupper($_REQUEST['estado']);
        $observacao = strtoupper($_REQUEST['observacao']);
        $profissao = strtoupper($_REQUEST['profissao']);
        $login = $_REQUEST['login'];
        $senha = $_REQUEST['senha'];
        
        $senhaSQL = "";

        if($senha != ""){
            $senha = password_hash($senha, PASSWORD_BCRYPT);
            $senhaSQL = ", senha = '$senha'";
        }

        $sql = "UPDATE  pessoafisica SET  nome = '$nome', cpf = '$cpf', rg = '$rg', email = '$email', telefone = '$telefone', celular = '$celular', dtNascimento = '$dtNascimento', genero = '$genero', logradouro = '$logradouro', numero = '$numero', bairro = '$bairro', cidade = '$cidade', estado = '$estado', observacao = '$observacao' WHERE id_pessoafisica = '$id_pessoafisica';

        UPDATE usuario SET login = '$login' {$senhaSQL} WHERE id_pessoafisica = '$id_pessoafisica';

        UPDATE responsavel SET profissao = '$profissao', foneComercial = '$telefoneCom' WHERE id_responsavel = '$id_responsavel';";
        //print $sql;
        $result = $GLOBALS['conn']->multi_query($sql) or die($GLOBALS['conn']->error.__LINE__);
        
        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($result);
    }

    function responsavelDelete(){
        $id_responsavel = $_REQUEST['id_responsavel'];
        $id_pessoa =  $_REQUEST['id_pessoaFisica'];

        $sql = "DELETE FROM responsavel where id_responsavel = '$id_responsavel';
        DELETE FROM usuario WHERE id_PessoaFisica = '$id_pessoa';";
        //print $sql;

        $result = $GLOBALS['conn']->multi_query($sql) or die($GLOBALS['conn']->error.__LINE__);
        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($result);
    }

    $operacao = $_REQUEST['operacao'];



    // Listar 1
    // GET 2
    // Insert 3
    // Update 4
    // Delete 5
    if($operacao == 1){
        responsavelList();
    } elseif ($operacao == 2){
        responsavelGet();
    } elseif ($operacao == 3){
        responsavelInsert();
    } elseif ($operacao == 4){
        responsavelUpdate();
    } elseif ($operacao == 5){
        responsavelDelete();
    }
?>