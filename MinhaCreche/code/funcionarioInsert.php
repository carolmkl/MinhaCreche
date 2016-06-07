<?php
    include 'conexaodb.php';

	$id_funcionario = $_REQUEST['id_funcionario'];
	$id_pessoafisica = $_REQUEST['id_pessoafisica'];
	$nome = strtoupper($_REQUEST['nome']);
	$cpf = $_REQUEST['cpf'];
	$rg = $_REQUEST['rg'];
	$email = $_REQUEST['email'];
	$telefone = $_REQUEST['telefone'];
	$celular = $_REQUEST['celular'];
	$dtNascimento = $_REQUEST['dtNascimento'];
	$genero = $_REQUEST['genero'];
	$logradouro = strtoupper($_REQUEST['logradouro']);
	$numero = $_REQUEST['numero'];
	$bairro = strtoupper($_REQUEST['bairro']);
	$cidade = strtoupper($_REQUEST['cidade']);
	$estado = strtoupper($_REQUEST['estado']);
	$observacao = strtoupper($_REQUEST['observacao']);
	$cargo = $_REQUEST['cargo'];
	$login = $_REQUEST['login'];
	$senha = $_REQUEST['senha'];

    //$mysqltime = date ("Y-m-d", $phptime);
    //$mysqltime = date ("Y-m-d", $phptime);
    
    //print $sql;
                
    $senha = password_hash($senha, PASSWORD_BCRYPT);

    $sql = "INSERT INTO  pessoafisica  (nome,cpf,rg,email,telefone,celular,dtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao) VALUES ('$nome','$cpf','$rg','$email','$telefone','$celular','$dtNascimento','$genero','$logradouro','$numero','$bairro','$cidade','$estado','$observacao');
    SELECT @pf:=max(id_pessoaFisica) FROM pessoafisica;

    INSERT INTO usuario (id_PessoaFisica, login, senha, nivel) VALUES (@pf, '$login', '$senha', '$cargo');

    INSERT INTO funcionario (id_creche, id_pessoaFisica, cargo) VALUES ( 1, @pf, '$cargo');";

    $result = $conn->multi_query($sql) or die($conn->error.__LINE__);
    //echo $result;
    mysqli_close($conn);
    echo $json_response = json_encode($result);
                
?>