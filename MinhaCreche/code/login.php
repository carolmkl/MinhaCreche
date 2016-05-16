<?php

if(isset($_POST['login']) && isset($_POST['senha']) ){
    include "conexaodb.php";

    $usuario = mysqli_escape_string($conn,$_POST['login']);
    $senha = mysqli_escape_string($conn,$_POST['senha']);
        
        
    /*Aqui verificamos se o usuario e senha digitados no formulário existem e estão corretos*/
    $sql = "SELECT u.nivel, u.senha, u.id_PessoaFisica, pf.nome, f.id_creche, f.id_Funcionario, r.id_responsavel FROM pessoafisica pf inner join usuario u on u.id_PessoaFisica = pf.id_pessoaFisica left join funcionario f on pf.id_pessoaFisica = f.id_pessoaFisica left join responsavel r on pf.id_pessoaFisica = r.id_pessoaFisica where u.login = '$usuario';";
    $result = mysqli_query($conn,$sql);
    
    if($result === FALSE) {
        echo $sql;
        echo mysqli_error($conn);
    }

    if(mysqli_num_rows($result) < 1){
       echo 0;
    } 
    else 
    {
        $row = mysqli_fetch_assoc($result);
        //grava os dados da sessão
        if(password_verify($senha, $row['senha'])){
            session_start();
            $_SESSION['mclogin']=$usuario;
            $_SESSION['mcpassword']=$senha;
            $_SESSION['mc_user_nome']=$row['nome'];
            $_SESSION['mc_user_nivel']=$row['nivel'];
            $_SESSION['mc_pessoa_id']=$row['id_PessoaFisica'];
            $_SESSION['mc_funcionario_id']=$row['id_Funcionario'];
            $_SESSION['mc_creche_id']=$row['id_creche'];
            $_SESSION['mc_responsavel_id']=$row['id_responsavel'];
            echo 1;
        } else {
            echo 0;
        }
    }

    mysqli_close($conn);
}else{
    echo 0;
}

?> 