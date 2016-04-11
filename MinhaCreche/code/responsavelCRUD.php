<?php 
    require_once 'conexaodb.php'; // The mysql database connection script
    
    function responsavelList(){
        
        $sql="select r.id_responsavel, r.id_pessoaFisica, r.profissao, pf.nome, pf.celular, pf.telefone from minhacreche.responsavel r inner join pessoafisica pf on r.id_pessoaFisica = pf.id_pessoafisica;";
        $result = $GLOBALS['conn']->query($sql) or die($mysqli->error.__LINE__);

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

    $operacao = $_REQUEST['operacao'];

    if($operacao == 1){
        responsavelList();
        exit;
    }
?>