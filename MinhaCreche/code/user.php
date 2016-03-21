<?php


include "conexaodb.php";


    if ( isset($_POST['login']) && isset($_POST['senha']) ) {

        $vLogin = $_POST['login'];
        $vSenha = $_POST['senha'];
        
        /*Aqui verificamos se o usuario e senha digitados no formulário existem e estão corretos*/
    $sql = "SELECT 'ok' FROM usuario WHERE login='".mysqli_escape_string($conn,$usuario)."' and senha='".mysqli_escape_string($conn,$senha)."'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) < 1){
        mysqli_close($conn);
       echo false;
    } else {
        //if ( $vLogin == "admin" && $vSenha == "admin" ) {
            session_start();
            $_SESSION['mclogin']=$usuario;
            $_SESSION['mcpassword']=$senha;
            mysqli_close($conn);
            echo true;
        //} else {
        }   
    }

//}

?>