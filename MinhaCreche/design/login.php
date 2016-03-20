<?php

if(!isset($_POST["Submit"])){
    include "index.html";
}else{
    include "conexaodb.php";

    $usuario = $_REQUEST["mclogin"];
    $senha = $_REQUEST["mcpassword"];


    /*Aqui verificamos se o usuario e senha digitados no formulário existem e estão corretos*/
    $sql = "SELECT 'ok' FROM usuario WHERE login='".mysqli_escape_string($conn,$usuario)."' and senha='".mysqli_escape_string($conn,$senha)."'";
    $result = mysqli_query($conn,$sql);

    if($result === FALSE) { 
        echo $sql;
        echo mysqli_error($conn);
    }

    if(mysqli_num_rows($result) < 1){
       echo "Login ou senha errado(s)!!";
       include "index.html";
    } 
    else 
    {
       /*Apos verificado ele grava o usuario e senha no vetor $_session[]*/
       session_start();
       $_SESSION['mclogin']=$usuario;
       $_SESSION['mcpassword']=$senha;
       header("Location: home.php");
    }

    mysqli_close($conn);
}

?> 