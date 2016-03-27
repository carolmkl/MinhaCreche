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




$sql = "update funcionario SET cargo = '' WHERE id_Funcionario = ;";
print $sql;

$result = $conn->query($sql) or die($conn->error.__LINE__);

echo $json_response = json_encode($result);

?>