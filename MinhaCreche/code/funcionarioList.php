<?php 
require_once 'conexaodb.php'; // The mysql database connection script

$sql="select f.id_funcionario,f.cargo, pf.nome, pf.celular from minhacreche.funcionario f inner join pessoafisica pf on f.id_pessoaFisica = pf.id_pessoafisica;";
$result = $conn->query($sql) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}

# JSON-encode the response
echo $json_response = json_encode($arr);
?>