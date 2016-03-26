<?php
include 'conexaodb.php';

$id_funcionario = $_REQUEST['id_funcionario'];

$sql = "delete from funcionario where id_funcionario = $id_funcionario;";
print $sql;

$result = $conn->query($sql) or die($conn->error.__LINE__);

echo $json_response = json_encode($result);

?>