<?php
    class DAO{
        private $dbserver = "localhost";
        private $dbuser = "admin";
        private $dbpass = "admin";
        private $dbname = "minhacreche";
        
        private function abrir(){
            $conn = new mysqli($dbserver,$dbuser,$dbpass,$dbname);
            
            if ($conn->connect_error) {
                echo "<p>Connection failed: ".$conn->connect_error."</p>";
                die("Connection failed: " . $conn->connect_error);
            }
            
            return $conn;
        }
        
        private function fechar($conn){
            mysqli_close($conn);
        }
        
        private function executar($conn, $sql){
            $resultado = $conn->multi_query($sql);
            
            if($resultado){
                return $resultado;
            } else {
                $this->sqlErro($conn, $sql);
            }
        }
        
        private function sqlErro($conn, $sql){
            echo mysqli_error ( $con ) . '<br>';
            die ( 'error: ' . $sql );
        }
        
        public function executarInsert($tabelas=array(), $colunas=array(), $dados=array()){
            $conn = $this->abrir();
            if(count($colunas) == count($dados) && count($colunas) == count($tabelas) && count($colunas) > 0){
                $sql = "BEGGIN;";
                for($i = 0; $i < count($tabelas); $i++){
                    $sql .= "INSERT INTO '$tabelas[$i]'  ('$colunas[$i]') VALUES ('$dados[$i]');";
                }
                try{
                    $this->executar($conn, $sql);
                    $sql = "COMMIT;";
                    $this->executar($conn, $sql);
                } catch(Exception $e){
                    $sql = "ROLLBACK;";
                    $this->executar($conn, $sql);
                } finally {
                    $this->fechar($conn);
                }
            } else {
                $this->fechar($conn);
                die ( 'error: Dados errados');
            }
        }
        
        public function executarInsertChaves($tabelas=array(), $colunas=array(), $dados=array(), $colunaChave){
            $conn = $this->abrir();
            if(count($colunas) == count($dados) && count($colunas) == count($tabelas) && count($colunas) > 0){
                $sql = "BEGGIN;";
                $sql .= "INSERT INTO '$tabelas[0]'  ('$colunas[0]') VALUES ('$dados[0]');
                SELECT @pf:=max('$colunaChave') FROM '$tabelas[0]';";
                
                for($i = 1; $i < count($tabelas); $i++){
                    $sql .= "INSERT INTO  '$tabelas[$i]'  ('$colunas[$i]') VALUES ('$dados[$i]');";
                }
                try{
                    $this->executar($conn, $sql);
                    $sql = "COMMIT;";
                    $this->executar($conn, $sql);
                } catch(Exception $e){
                    $sql = "ROLLBACK;";
                    $this->executar($conn, $sql);
                } finally {
                    $this->fechar($conn);
                }
            } else {
                $this->fechar($conn);
                die ( 'error: Dados errados');
            }
        }
        
    }
?>