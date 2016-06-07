<?php
    include 'conexaodb.php';

    function podeLogin($id_pessoa, $login){
        $sql = "SELECT id_PessoaFisica from usuario WHERE  login = '$login';";
        //print $sql;
        $result = $GLOBALS['conn']->query($sql) or die($conn->error.__LINE__);
        
        if(isset($result)){
            if($result->num_rows == 0) {
                return true;
            } else {
                $arr = $result->fetch_assoc();
                if($arr['id_PessoaFisica'] == $id_pessoa){
                    return true;
                } else{
                    return false;
                }
            }
        }
        
        return false;
    }

    function podeCpf($id_pessoa, $cpf){
        $sql = "SELECT id_PessoaFisica from pessoafisica WHERE  cpf = '$cpf';";
        //print $sql;
        $result = $GLOBALS['conn']->query($sql) or die($conn->error.__LINE__);
        
        if(isset($result)){
            if($result->num_rows == 0) {
                return true;
            } else {
                $arr = $result->fetch_assoc();
                if($arr['id_PessoaFisica'] == $id_pessoa){
                    return true;
                } else{
                    return false;
                }
            }
        }
        return false;
    }

    function podeSenha($id_pessoa, $senha){       
        $sql = "SELECT usuario.senha, usuario.id_PessoaFisica  FROM usuario";
        $result = $GLOBALS['conn']->query($sql) or die($conn->error.__LINE__);

        $arr = array();        
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $arr[] = $row;	
            }

            $pode = true;
            foreach($arr as $value){
                if(password_verify($senha, $value['senha']) && $value['id_PessoaFisica'] != $id_pessoa){
                    $pode = false;
                    break;
                }
            }
            unset($value);
        }
    
        return $pode;
    }

    $operacao = $_REQUEST['operacao'];
    $id_pessoafisica = $_REQUEST['id_pessoafisica'];
    $loginG = $_REQUEST['login'];
    $senhaG = $_REQUEST['senha'];

    const tudo = 1;
    const loginSenha = 2;

    if ($operacao == tudo){
        
        $cpfG = $_REQUEST['cpf'];
        if(podeLogin($id_pessoafisica, $loginG)){
            if(podeSenha($id_pessoafisica, $senhaG)){
                if(podeCpf($id_pessoafisica, $cpfG)){
                    echo $json_response = json_encode(true);
                } else {
                    echo $json_response = json_encode("cpf");
                }
            } else {
                echo $json_response = json_encode("senha");
            }
        } else {
            echo $json_response = json_encode("login");
        }
        
    } elseif ($operacao == loginSenha){
        
         if(podeLogin($id_pessoafisica, $loginG)){
            if(podeSenha($id_pessoafisica, $senhaG)){
                echo $json_response = json_encode(true);
            } else {
                echo $json_response = json_encode("senha");
            }
        } else {
            echo $json_response = json_encode("login");
        }
        
    }

    mysqli_close($GLOBALS['conn']);
?>