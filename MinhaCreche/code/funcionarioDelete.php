<?php
include 'conexaodb.php';

$id_funcionario = $_REQUEST['id_funcionario'];
$id_pessoa =  $_REQUEST['id_pessoaFisica'];

$sql = "DELETE FROM funcionario where id_funcionario = '$id_funcionario';
DELETE FROM usuario WHERE id_PessoaFisica = '$id_pessoa';";
print $sql;

$result = $conn->multi_query($sql) or die($conn->error.__LINE__);

echo $json_response = json_encode($result);

?>