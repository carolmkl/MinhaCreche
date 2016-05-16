<?php
    include "conexaodb.php";

    $login = $_REQUEST['login'];

    $sql = "SELECT usuario.senha FROM usuario";
    $result=mysqli_query($conn,$sql);

    $arr = array();        
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $arr[] = $row;	
        }
        
        $pode = true;
        $senha = "";
        while($pode){
            $senha = chr(rand(65,90)) . chr(rand(65,90)) . chr(rand(65,90)) . rand(0,9) . rand(0,9) . rand(0,9);
            $pode = false;
            foreach($arr as $value){
                if(password_verify($senha, $value['senha'])){
                    $pode = true;
                }
            }
            unset($value);
        }
        
        $sql = "SELECT pf.email FROM pessoafisica pf INNER JOIN usuario u ON pf.id_pessoaFisica = u.id_pessoaFisica WHERE u.login = '$login';";
        $result=mysqli_query($conn,$sql);
        //echo $sql;
        //echo json_encode($result);
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if(strlen($row['email'])>0){
                    // the message
                $msg = "Sua nova senha do Minha Creche é: '$senha'";

                // use wordwrap() if lines are longer than 70 characters
                $msg = wordwrap($msg,70);

                // send email
                $resultado = mail($row['email'],"Nova senha",$msg);   
                echo json_encode($resultado);
            }
        }
    } else {
        echo json_encode(false);
    }
?>