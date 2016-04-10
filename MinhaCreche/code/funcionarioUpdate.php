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

    $senhaSQL = "";

    if($senha != ""){
        $senha = password_hash($senha, PASSWORD_BCRYPT);
        $senhaSQL = ", senha = '$senha'";
    }

$sql = "UPDATE funcionario SET cargo = '$cargo' WHERE id_Funcionario = '$id_funcionario';

        UPDATE pessoafisica SET nome = '$nome', cpf = '$cpf', rg = '$rg', email = '$email', telefone = '$telefone', celular = '$celular', dtNascimento = '$dtNascimento', genero = '$genero', logradouro = '$logradouro', numero = '$numero', bairro = '$bairro', cidade = '$cidade', estado = '$estado', observacao = '$observacao' WHERE id_pessoafisica = '$id_pessoafisica';
        
        UPDATE usuario SET  login = '$login' {$senhaSQL}, nivel = '$cargo' WHERE id_pessoafisica = '$id_pessoafisica';";

$result = $conn->multi_query($sql) or die($conn->error.__LINE__);
//echo $result;
echo $json_response = json_encode($result);
?>