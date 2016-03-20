<?php

//Esse sesion_start() inicia a sessão dando acesso ao vetor $_session[]/*
session_start();

//coletamos os dados existentes na sessão.../*
if(IsSet($_SESSION['mclogin']))
   $nome_usuario=$_SESSION['mclogin'];
if(IsSet($_SESSION['mcpassword']))
   $senha_usuario=$_SESSION['mcpassword'];

   //aqui vamos verificar se temos algo registrado/*
   if(!(empty($nome_usuario) OR empty($senha_usuario)))
   {
      
      //Abre a conexão com o mysql e seleciona o banco/*
      include "conexaodb.php";

      $sql = "SELECT 'ok' FROM usuario WHERE login='".mysqli_escape_string($conn,$nome_usuario)."' and senha='".mysqli_escape_string($conn,$senha_usuario)."'";
      $result=mysqli_query($conn,$sql);
      

      if($result === FALSE) { 
           echo $sql;
           echo mysqli_error($conn);
       }

       if(mysqli_num_rows($result) < 1){
            unset($_SESSION['mclogin']);
            unset($_SESSION['mcpassword']);
            echo "Você não efetuou o login!";
            include "login.php";
            exit();
       } 
   }
   else
   {
   echo "Você não efetuou o Login!";
   include "login.php";
   exit();
   }

mysqli_close($conn);
   
?>