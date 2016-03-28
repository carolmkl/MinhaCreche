<?php
include 'conexaodb.php';

	$id_funcionario = $_REQUEST['id_funcionario'];
	$id_pessoafisica = $_REQUEST['id_pessoafisica'];
	$nome = $_REQUEST['nome'];
	$cpf = $_REQUEST['cpf'];
	$rg = $_REQUEST['rg'];
	$email = $_REQUEST['email'];
	$telefone = $_REQUEST['telefone'];
	$celular = $_REQUEST['celular'];
	$dtNascimento = $_REQUEST['dtNascimento'];
	$genero = $_REQUEST['genero'];
	$logradouro = $_REQUEST['logradouro'];
	$numero = $_REQUEST['numero'];
	$bairro = $_REQUEST['bairro'];
	$cidade = $_REQUEST['cidade'];
	$estado = $_REQUEST['estado'];
	$observacao = $_REQUEST['observacao'];
	$cargo = $_REQUEST['cargo'];
	$login = $_REQUEST['login'];
	$senha = $_REQUEST['senha'];



$sql = "insert INTO  pessoafisica  (nome,cpf,rg,email,telefone,celular,dtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao)VALUES('$nome','$cpf','$rg','$email','$telefone','$celular','$dtNascimento','$genero','$logradouro','$numero','$bairro','$cidade','$estado','$observacao'); 

SELECT max(id_pessoaFisica) into @pf FROM minhacreche.pessoafisica;

INSERT INTO minhacreche.usuario (id_PessoaFisica, login, senha, nivel) VALUES (@pf, '$login', '$senha', '$cargo');

INSERT INTO minhacreche.funcionario (id_creche, id_pessoaFisica, cargo) VALUES ( 1, @pf, '&cargo');";



print $sql;

$result = $conn->query($sql) or die($conn->error.__LINE__);

echo $json_response = json_encode($result);

?>