<?php 
require_once 'conexaodb.php'; // The mysql database connection script

if(isset($_REQUEST['id_funcionario'])){

	$id_funcionario = $_REQUEST['id_funcionario'];

	$sql="select f.id_funcionario,f.cargo, pf.*, u.login, u.senha from minhacreche.funcionario f inner join pessoafisica pf on f.id_pessoaFisica = pf.id_pessoafisica inner join usuario u on u.id_pessoafisica = pf.id_pessoafisica where f.id_funcionario = $id_funcionario;";

	//echo $sql;

	$result = $conn->query($sql) or die($conn->error.__LINE__);

	$arr = array();
	if($result->num_rows > 0) {
		$arr[] = $result->fetch_assoc();
	}

	# JSON-encode the response
    mysqli_close($conn);
	echo $json_response = json_encode($arr);
}
?>