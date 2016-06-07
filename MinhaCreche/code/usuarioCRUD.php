<?php
    require_once 'conexaodb.php'; // The mysql database connection script

    function usuarioUpdate(){
        $id_pessoafisica = $_REQUEST['id_pessoafisica'];
        $login = $_REQUEST['login'];
        $senha = $_REQUEST['senha'];
        
        
        $senhaSQL = "";

        if($senha != ""){
            $senha = password_hash($senha, PASSWORD_BCRYPT);
            $senhaSQL = ", senha = '$senha'";
        }

        $sql = "UPDATE  usuario SET login = '$login' {$senhaSQL} WHERE id_PessoaFisica = '$id_pessoafisica';";

        //print $sql;
        $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);

        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($result);
    }


    $operacao = $_REQUEST['operacao'];

    const update = 4;

    if ($operacao == update){
        usuarioUpdate();
    }
?>