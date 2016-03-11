<?php
    if ( isset($_POST['login']) && isset($_POST['senha']) ) {

        $vLogin = $_POST['login'];
        $vSenha = $_POST['senha'];

        if ( $vLogin == "admin" && $vSenha == "admin" ) {
            echo true;
        } else {
            echo false;
        }

    }

?>