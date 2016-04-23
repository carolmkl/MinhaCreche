<?php 
    require_once 'conexaodb.php'; // The mysql database connection script
    
    function criancaList(){
        
        $sql="select c.id_crianca, c.nome from minhacreche.crianca c;";
        $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);

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

    function criancaGet(){
        $id_crianca = $_REQUEST['id_crianca'];

        $sql="select c.* from minhacreche.crianca c where c.id_crianca = $id_crianca;";

        //echo $sql;

        $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);

        $arr = array();
        if($result->num_rows > 0) {
            $arr[] = $result->fetch_assoc();
        }
        mysqli_close($GLOBALS['conn']);
        # JSON-encode the response
        echo $json_response = json_encode($arr);
    }

    function criancaInsert(){
        $id_crianca = $_REQUEST['id_crianca'];
        $nome = strtoupper($_REQUEST['nome']);
        $dtNascimento = $_REQUEST['dtNascimento'];
        $genero = $_REQUEST['genero'];
        $observacao = strtoupper($_REQUEST['observacao']);
        $responsaveis = json_decode($_REQUEST['responsaveis']);


        $sql = "INSERT INTO  crianca  (id_creche, nome, genero, dtNascimento, obs) VALUES (1, '$nome', '$genero', '$dtNascimento', '$observacao');
        SELECT @pf:=max(id_crianca) FROM crianca;";
        
        foreach($responsaveis as $responsavel){
            $string = strtoupper($responsavel->parentesco);
            $sql .= "INSERT INTO responsavelcrianca (id_responsavel, id_crianca, parentesco) VALUES ('{$responsavel->id}', @pf, '$string');";    
        }
        unset($responsavel);
        //echo $sql;
        $result = $GLOBALS['conn']->multi_query($sql) or die($GLOBALS['conn']->error.__LINE__);
        //echo $result;
        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($result);
    }

    function criancaUpdate(){
        $id_crianca = $_REQUEST['id_crianca'];
        $nome = strtoupper($_REQUEST['nome']);
        $dtNascimento = $_REQUEST['dtNascimento'];
        $genero = $_REQUEST['genero'];
        $observacao = strtoupper($_REQUEST['observacao']);
        $responsaveis = json_decode($_REQUEST['responsaveis']);
        
       
        $sql = "UPDATE  crianca SET  nome = '$nome', genero = '$genero', dtNascimento = '$dtNascimento', obs = '$observacao' WHERE id_crianca = '$id_crianca';

        DELETE FROM responsavelcrianca where id_crianca = '$id_crianca';";
        foreach($responsaveis as $responsavel){
            $string = strtoupper($responsavel->parentesco);
            $sql .= "INSERT INTO responsavelcrianca (id_responsavel, id_crianca, parentesco) VALUES ('{$responsavel->id}', '$id_crianca', '$string');";    
        }
        //print $sql;
        $result = $GLOBALS['conn']->multi_query($sql) or die($GLOBALS['conn']->error.__LINE__);
        
        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($result);
    }

    function responsavelDelete(){
        $id_responsavel = $_REQUEST['id_responsavel'];
        $id_pessoa =  $_REQUEST['id_pessoaFisica'];

        $sql = "DELETE FROM responsavel where id_responsavel = '$id_responsavel';
        DELETE FROM usuario WHERE id_PessoaFisica = '$id_pessoa';";
        //print $sql;

        $result = $GLOBALS['conn']->multi_query($sql) or die($GLOBALS['conn']->error.__LINE__);
        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($result);
    }

    function criancaResponsavelGet(){
        $id_crianca = $_REQUEST['id_crianca'];

        $sql="select r.* from minhacreche.responsavelcrianca c where r.id_crianca = $id_crianca;";

        //echo $sql;

        $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);

        $arr = array();
        if($result->num_rows > 0) {
            $arr[] = $result->fetch_assoc();
        }
        mysqli_close($GLOBALS['conn']);
        # JSON-encode the response
        echo $json_response = json_encode($arr);
    }

    $operacao = $_REQUEST['operacao'];



    // Listar 1
    // GET 2
    // Insert 3
    // Update 4
    // Delete 5
    // GET Responsaveis 6
    if($operacao == 1){
        criancaList();
    } elseif ($operacao == 2){
        criancaGet();
    } elseif ($operacao == 3){
        criancaInsert();
    } elseif ($operacao == 4){
        criancaUpdate();
    } elseif ($operacao == 5){
        //responsavelDelete();
    } elseif ($operacao == 6){
        criancaResponsavelGet();
    }
?>