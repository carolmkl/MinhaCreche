<?php
include 'conexaodb.php';

$id_creche = $_REQUEST['id_creche'];
$nome = $_REQUEST['nome'];
$cnpj = $_REQUEST['cnpj'];
$email = $_REQUEST['email'];
$telefone1 = $_REQUEST['telefone1'];
$telefone2 = $_REQUEST['telefone2'];
$logradouro = $_REQUEST['logradouro'];
$numero = $_REQUEST['numero'];
$bairro = $_REQUEST['bairro'];
$cidade = $_REQUEST['cidade'];
$estado = $_REQUEST['estado'];
$observacao = $_REQUEST['observacao'];



$sql = "update minhacreche.creche SET nome = '$nome', cnpj = '$cnpj', email = '$email', telefone1 = '$telefone1', telefone2 = '$telefone2',  logradouro = '$logradouro', numero = '$numero', bairro = '$bairro', cidade = '$cidade', estado = '$estado', observacao = '$observacao' WHERE id_creche = $id_creche;";
print $sql;

$result = $conn->query($sql) or die($conn->error.__LINE__);
mysqli_close($conn);
echo $json_response = json_encode($result);

?>