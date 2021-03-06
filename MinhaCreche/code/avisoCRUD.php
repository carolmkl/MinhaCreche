<?php
    require_once 'conexaodb.php'; // The mysql database connection script


    function avisoList(){
        $nivel = $_REQUEST['nivelAviso'];
        $id_pessoaFisica =  $_REQUEST['id_pessoaFisica'];
        $sql = "";
        //$data = date('Y-m-d'); // uso pra validação de datas trocada por NOW()
        
        if($nivel < 4){
            // exibir/enviado
//            $sql="select a.*, p.nome, d.dtLido from minhacreche.aviso a INNER JOIN destinatario d ON d.id_Aviso = a.id_Aviso INNER JOIN pessoafisica p ON a.id_pessoaFisica = p.id_pessoaFisica WHERE d.id_pessoaFisica = '$id_pessoaFisica' AND a.nivel = '$nivel' AND dataEntrega <= NOW() ORDER BY a.dataEntrega DESC;";
            $sql="select a.*, p.nome, d.dtLido from minhacreche.aviso a INNER JOIN destinatario d ON d.id_Aviso = a.id_Aviso INNER JOIN pessoafisica p ON a.id_pessoaFisica = p.id_pessoaFisica WHERE d.id_pessoaFisica = '$id_pessoaFisica' AND dataEntrega <= NOW() ORDER BY a.dataEntrega DESC;";
        } else {
            // exibir/não enviado
            $sql="select a.*, c.nome from minhacreche.aviso a INNER JOIN crianca c ON a.id_crianca = c.id_crianca WHERE a.id_pessoaFisica = '$id_pessoaFisica' AND dataEntrega > NOW() ORDER BY a.dataEntrega;";
        }

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

    function avisoGet(){
        $id_aviso = $_REQUEST['id_Aviso'];

        $sql="select a.* from minhacreche.aviso a where a.id_Aviso = $id_aviso;";

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

    function avisoInsert(){
        $id_crianca = $_REQUEST['id_crianca'];
        $id_pessoaFisica = $_REQUEST['id_pessoaFisica'];
        $nivel = $_REQUEST['nivel'];
        $dtEnvio = $_REQUEST['dtEnvio'];
        $menssagem = strtoupper($_REQUEST['messagem']);
        $destinatarios = json_decode($_REQUEST['destinatarios']);


        $sql = "INSERT INTO  aviso  (id_pessoaFisica, id_crianca, tx_mensagem, nivel, dataEntrega) VALUES ('$id_pessoaFisica', '$id_crianca', '$menssagem', '$nivel', '$dtEnvio');
        SELECT @pf:=max(id_Aviso) FROM aviso;";
        
        foreach($destinatarios as $destinatario){
            $sql .= "INSERT INTO destinatario (id_Aviso, id_pessoaFisica) VALUES (@pf, {$destinatario->id_pessoafisica});";    
        }
        unset($destinatario);
        //echo $sql;
        $result = $GLOBALS['conn']->multi_query($sql) or die($GLOBALS['conn']->error.__LINE__);
        //echo $result;
        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($result);
    }

    function avisoUpdate(){
        $id_aviso = $_REQUEST['id_aviso'];
        $id_crianca = $_REQUEST['id_crianca'];
        $id_pessoaFisica = $_REQUEST['id_pessoaFisica'];
        $nivel = $_REQUEST['nivel'];
        $dtEnvio = $_REQUEST['dtEnvio'];
        $menssagem = strtoupper($_REQUEST['messagem']);
        $destinatarios = json_decode($_REQUEST['destinatarios']);
        
       
        $sql = "UPDATE  aviso SET   tx_mensagem = '$menssagem', nivel = '$nivel', dataEntrega = '$dtEnvio' WHERE id_Aviso = '$id_aviso';

        DELETE FROM destinatario WHERE id_Aviso = '$id_aviso';";
        foreach($destinatarios as $destinatario){
            $sql .= "INSERT INTO destinatario (id_Aviso, id_pessoaFisica) VALUES ('$id_aviso', {$destinatario->id_pessoafisica});";    
        }
        unset($destinatario);
        //print $sql;
        $result = $GLOBALS['conn']->multi_query($sql) or die($GLOBALS['conn']->error.__LINE__);
        
        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($result);
    }

    function avisoDelete(){
        $id_aviso = $_REQUEST['id_aviso'];

        $sql = "DELETE FROM destinatario where id_Aviso = '$id_aviso';
                DELETE FROM aviso where id_Aviso = '$id_aviso';";
        //print $sql;

        $result = $GLOBALS['conn']->multi_query($sql) or die($GLOBALS['conn']->error.__LINE__);
        mysqli_close($GLOBALS['conn']);
        echo $json_response = json_encode($result);
    }




// aqui ta bom
    function criancaResponsavelGet(){
        $id_crianca = $_REQUEST['id_crianca'];

        $sql="select p.id_pessoafisica, p.nome, rc.parentesco from minhacreche.pessoafisica p inner join responsavel r on r.id_pessoafisica = p.id_pessoafisica inner join responsavelcrianca rc on rc.id_responsavel = r.id_responsavel where rc.id_crianca = $id_crianca;";

        //echo $sql;

        $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);

        
        $arr = array();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $arr[] = $row;	
            }
        }
        mysqli_close($GLOBALS['conn']);
        # JSON-encode the response
        echo $json_response = json_encode($arr);
    }

    function nivelResponsavelCriancaGet(){
        $id_responsavel = $_REQUEST['id_responsavel'];
        $sql="select c.id_crianca, c.nome from minhacreche.crianca c inner join responsavelcrianca rc on c.id_crianca = rc.id_crianca where rc.id_responsavel = $id_responsavel;";
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

    function nivelFuncionarioCriancaGet(){
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

    function criancaFuncionarioGet(){
        $id_crianca = $_REQUEST['id_crianca'];

        $sql="select p.id_pessoafisica, p.nome, f.cargo from minhacreche.pessoafisica p inner join funcionario f on f.id_pessoafisica = p.id_pessoafisica;";

        //echo $sql;

        $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);

        
        $arr = array();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $arr[] = $row;	
            }
        }
        mysqli_close($GLOBALS['conn']);
        # JSON-encode the response
        echo $json_response = json_encode($arr);
    }

    function datarAviso(){
        $id_aviso = $_REQUEST['id_Aviso'];
        $id_pessoaFisica = $_REQUEST['id_pessoaFisica'];
        
        $sql = "UPDATE destinatario set dtLido = NOW() WHERE id_Aviso = '$id_aviso' AND id_pessoaFisica = '$id_pessoaFisica';";
            
        $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);

        mysqli_close($GLOBALS['conn']);
        # JSON-encode the response
        echo $json_response = json_encode($result);
    }

    function getDestinatarios(){
        $id_aviso = $_REQUEST['id_Aviso'];
        
        $sql = "SELECT d.* FROM destinatario d WHERE d.id_Aviso = '$id_aviso';";
        
        $result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);
        $arr = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $arr[] = $row;
            }
        }
        mysqli_close($GLOBALS['conn']);
        # JSON-encode the response
        echo $json_response = json_encode($arr);
        
    }

	function getDadosRelatorioCrianca(){		
		$dataInicio = $_REQUEST['inicio'];
		$dataFim = $_REQUEST['fim'];
		
		$scriptDataInicio = "";
		$scriptDataFim = "";
		
		if($dataInicio != ""){
			$scriptDataInicio = " aviso.dataEntrega >= '{$dataInicio}' ";
		}
		if($dataFim != ""){
			$scriptDataInicio = " aviso.dataEntrega <= '{$dataFim}' ";
		}
		
		$sql = "SELECT crianca.nome, count(aviso.id_crianca) AS `numeroAviso` FROM `aviso` RIGHT JOIN crianca ON crianca.id_crianca = aviso.id_crianca ";
		
		if($scriptDataInicio != "" || $scriptDataFim != ""){
			$sql .= "WHERE";
			if($scriptDataInicio != ""){
				$sql .= $scriptDataInicio;
			}
			if($scriptDataInicio != "" && $scriptDataFim != ""){
				$sql .= "AND";
			}
			if($scriptDataFim != ""){
				$sql .= $scriptDataFim;
			}
		}
		
		$sql .= " GROUP BY crianca.id_crianca;";
		
		$result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);
		
		$return = array(
			'erro' => TRUE,
			'content' => NULL
		);
		
        $retorno = '';
        if($result->num_rows > 0){
			
			$return['erro'] = FALSE;
			
            while($row = $result->fetch_assoc()){
                if($retorno != ''){
					$retorno .= ',';
				}
				$retorno .= '{"c":[{"v":"' . $row['nome'] . '"}, {"v":"' . $row['numeroAviso'] . '"}]}';
            }
			
			$retorno = '{"cols":[{"label":"Criança", "type":"string"}, {"label":"Numero de Avisos", "type":"number"}], "rows":[' . $retorno . ']}';
			
			$return['content'] = $retorno;
        } else {
			$return['content'] = "Sem dados";
		}
        mysqli_close($GLOBALS['conn']);
		echo json_encode($return);
	}

	function getDadosRelatorioPessoaFisica(){		
		$dataInicio = $_REQUEST['inicio'];
		$dataFim = $_REQUEST['fim'];
		$tipo = $_REQUEST['tipo'];
		
		$scriptDataInicio = "";
		$scriptDataFim = "";
		
		if($dataInicio != ""){
			$scriptDataInicio = " aviso.dataEntrega >= '{$dataInicio}' ";
		}
		if($dataFim != ""){
			$scriptDataInicio = " aviso.dataEntrega <= '{$dataFim}' ";
		}

		$sql;
		
		$sql = "SELECT pessoafisica.nome AS `nomePessoa`, pessoafisica.id_pessoaFisica AS `idPessoa`, crianca.nome AS `nomeCrianca`, crianca.id_crianca AS `idCrianca`, count(aviso.id_crianca) AS `numeroAviso` FROM `aviso` INNER JOIN crianca ON crianca.id_crianca = aviso.id_crianca 	INNER JOIN pessoaFisica ON pessoafisica.id_pessoaFisica = aviso.id_pessoaFisica ";

		if($scriptDataInicio != "" || $scriptDataFim != ""){
			$sql .= "WHERE";
			if($scriptDataInicio != ""){
				$sql .= $scriptDataInicio;
			}
			if($scriptDataInicio != "" && $scriptDataFim != ""){
				$sql .= "AND";
			}
			if($scriptDataFim != ""){
				$sql .= $scriptDataFim;
			}
		}

		$sql .= " GROUP BY aviso.id_pessoaFisica, aviso.id_crianca;";
		
		$result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);
		
		$return = array(
			'erro' => TRUE,
			'content' => NULL
		);
		
        $retorno = '';
        if($result->num_rows > 0){
			
			$return['erro'] = FALSE;
            if($tipo === "tabela"){
				while($row = $result->fetch_assoc()){
                if($retorno != ''){
					$retorno .= ',';
				}
					$retorno .= '{"c":[{"v":"' . $row['nomePessoa'] . '"}, {"v":"' . $row['nomeCrianca'] . '"}, {"v":"' . $row['numeroAviso'] . '"}]}';
				}

				$retorno = '{"cols":[{"label":"Pessoa", "type":"string"}, {"label":"Criança", "type":"string"}, {"label":"Numero de Avisos", "type":"number"}], "rows":[' . $retorno . ']}';
			} else {
				$arraydados = array();
				$arrayCrianca = array();
				while($row = $result->fetch_assoc()){
					$arraydados[$row['idPessoa']]['nome'] = $row['nomePessoa'];
					$arraydados[$row['idPessoa']][$row['idCrianca']] = $row['numeroAviso'];
				}
				
				$sql = "SELECT crianca.nome, crianca.id_crianca AS `idCrianca` FROM crianca;";
				$result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$arrayCrianca[$row['idCrianca']] = array(
							'id' => $row['idCrianca'],
							'nome' => $row['nome']
						);
					}
				}
				
				foreach($arraydados as $dado){
					if($retorno != ''){
						$retorno .= ',';
					}
					$retorno .= '{"c":[{"v":"' . $dado['nome'] . '"}, ';
					$numeros = '';
					foreach($arrayCrianca as $crianca){
						if($numeros != ''){
							$numeros .= ',';
						}
						if(isset($dado[$crianca['id']])){
							$numeros .= '{"v":"' . $dado[$crianca['id']] . '"}';
						} else {
							$numeros .= '{"v":"0"}';
						}
					}
					unset($crianca);
					$retorno .= $numeros . ']}';
				}
				unset($dado);	
				
				$colunas = '';
				foreach($arrayCrianca as $crianca){
					if($colunas != ''){
						$colunas .= ',';
					} else {
						$colunas .= '{"label":"Pessoa", "type":"string"},';
					}
					$colunas .= '{"label":"' . $crianca['nome'] . '", "type":"number"}';
				}
				unset($crianca);
				$retorno = '{"cols":[' . $colunas . '], "rows":[' . $retorno . ']}';
			}
			$return['content'] = $retorno;
        } else {
			$return['content'] = "Sem dados";
		}
        mysqli_close($GLOBALS['conn']);
		echo json_encode($return);
	}

	function getDadosRelatorioData(){		
		$dataInicio = $_REQUEST['inicio'];
		$dataFim = $_REQUEST['fim'];
		$tipo = $_REQUEST['tipo'];
		
		$scriptDataInicio = "";
		$scriptDataFim = "";
		
		if($dataInicio != ""){
			$scriptDataInicio = " aviso.dataEntrega >= '{$dataInicio}' ";
		}
		if($dataFim != ""){
			$scriptDataInicio = " aviso.dataEntrega <= '{$dataFim}' ";
		}
		
		$sql = "SELECT DATE_FORMAT(aviso.dataEntrega, '%d/%m/%y') AS `dataEntrega`, crianca.nome, crianca.id_crianca AS `idCrianca`, count(aviso.id_crianca) AS `numeroAviso` FROM `aviso` INNER JOIN crianca ON crianca.id_crianca = aviso.id_crianca ";
		
		if($scriptDataInicio != "" || $scriptDataFim != ""){
			$sql .= "WHERE";
			if($scriptDataInicio != ""){
				$sql .= $scriptDataInicio;
			}
			if($scriptDataInicio != "" && $scriptDataFim != ""){
				$sql .= "AND";
			}
			if($scriptDataFim != ""){
				$sql .= $scriptDataFim;
			}
		}
		
		$sql .= " GROUP BY aviso.dataEntrega, aviso.id_crianca;";
		
		$result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);
		
		$return = array(
			'erro' => TRUE,
			'content' => NULL
		);
		
        $retorno = '';
        if($result->num_rows > 0){
			
			$return['erro'] = FALSE;
			
            if($tipo === "tabela"){
				while($row = $result->fetch_assoc()){
					if($retorno != ''){
						$retorno .= ',';
					}
					$retorno .= '{"c":[{"v":"' . $row['dataEntrega'] . '"}, {"v":"' . $row['nome'] . '"}, {"v":"' . $row['numeroAviso'] . '"}]}';
				}

				$retorno = '{"cols":[{"label":"Data", "type":"string"}, {"label":"Criança", "type":"string"}, {"label":"Numero de Avisos", "type":"number"}], "rows":[' . $retorno . ']}';
			} else {
				$arraydados = array();
				$arrayCrianca = array();
				while($row = $result->fetch_assoc()){
					$arraydados[$row['dataEntrega']]['data'] = $row['dataEntrega'];
					$arraydados[$row['dataEntrega']][$row['idCrianca']] = $row['numeroAviso'];
				}
				
				$sql = "SELECT crianca.nome, crianca.id_crianca AS `idCrianca` FROM crianca;";
				$result = $GLOBALS['conn']->query($sql) or die($GLOBALS['conn']->error.__LINE__);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$arrayCrianca[$row['idCrianca']] = array(
							'id' => $row['idCrianca'],
							'nome' => $row['nome']
						);
					}
				}
				
				foreach($arraydados as $dado){
					if($retorno != ''){
						$retorno .= ',';
					}
					$retorno .= '{"c":[{"v":"' . $dado['data'] . '"}, ';
					$numeros = '';
					foreach($arrayCrianca as $crianca){
						if($numeros != ''){
							$numeros .= ',';
						}
						if(isset($dado[$crianca['id']])){
							$numeros .= '{"v":"' . $dado[$crianca['id']] . '"}';
						} else {
							$numeros .= '{"v":"0"}';
						}
					}
					unset($crianca);
					$retorno .= $numeros . ']}';
				}
				unset($dado);	
				
				$colunas = '';
				foreach($arrayCrianca as $crianca){
					if($colunas != ''){
						$colunas .= ',';
					} else {
						$colunas .= '{"label":"Data", "type":"string"},';
					}
					$colunas .= '{"label":"' . $crianca['nome'] . '", "type":"number"}';
				}
				unset($crianca);
				$retorno = '{"cols":[' . $colunas . '], "rows":[' . $retorno . ']}';
			}
			
			$return['content'] = $retorno;
        } else {
			$return['content'] = "Sem dados";
		}
        mysqli_close($GLOBALS['conn']);
		echo json_encode($return);
	}

    $operacao = $_REQUEST['operacao'];


    // Listar 1
    // GET 2
    // Insert 3
    // Update 4
    // Delete 5
    // GET Responsaveis da Criança 6
    // GET Crianças do responsavel 7
    // GET Crianças da Creche 8
    // GET os funcionários 9
    // DELETE view 10
    // Update data 11
    // GET Destinatarios 12

    const listar = 1;
    const get = 2;
    const insert = 3;
    const update = 4;
    const removerAviso = 5;
    const getResponsaveisDaCrianca = 6;
    const getCriancasDoResponsavel = 7;
    const getCriancasDaCreche = 8;
    const getFuncionarios = 9;
    const removerViewAviso = 10;
    const insertDataLeitura = 11;
    const getDestinatario = 12;
	const getRelatorioCrianca = 13;
	const getRelatorioPessoa = 14;	
	const getRelatorioData = 15;


    if($operacao == listar) {
        avisoList();
    } elseif ($operacao == get) {
        avisoGet();
    } elseif ($operacao == insert) {
        avisoInsert();
    } elseif ($operacao == update) {
        avisoUpdate();
    } elseif ($operacao == removerAviso) {
        avisoDelete();
    } elseif ($operacao == getResponsaveisDaCrianca) {
        criancaResponsavelGet();
    } elseif ($operacao == getCriancasDoResponsavel) {
        nivelResponsavelCriancaGet();
    } elseif ($operacao == getCriancasDaCreche) {
        nivelFuncionarioCriancaGet();
    } elseif ($operacao == getFuncionarios) {
        criancaFuncionarioGet();
    } elseif ($operacao == removerViewAviso) {
        avisoDeleteView();
    } elseif ($operacao == insertDataLeitura) {
        datarAviso();
    } elseif ($operacao == getDestinatario) {
        getDestinatarios();
    } elseif ($operacao == getRelatorioCrianca) {
		getDadosRelatorioCrianca();
	} elseif ($operacao == getRelatorioPessoa) {
		getDadosRelatorioPessoaFisica();
	} elseif ($operacao == getRelatorioData) {
		getDadosRelatorioData();
	}
?>