<?php

abstract class Usuario
{
    protected $cpf;
    protected $nome;
    protected $proficao;
    
    protected $dataNascimento;
    protected $genero;
    protected $email;
    
    protected $login;
    protected $senha;
    
    protected $telefone = array();
    
    public abstract function __construct($nome, $cpf, $proficao, $dataNascimento, $genero, $email, $login, $senha, $telefone);
    
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function getNome(){
        return $this->nome;
    }
    
    public function setCpf($cpf){
        $this->cpf = $cpf;
    }
    
    public function getCpf(){
        return $this->cpf;
    }
    
    public function setProficao($proficao){
        $this->proficao = $proficao;
    }
    
    public function getProficao(){
        return $this->proficao;
    }
    
    public function setDataNascimento($dataNascimento){
        $this->dataNascimento = $dataNascimento;
    }
    
    public function getDataNascimento(){
        return $this->dataNascimento;
    }
    
    public function setGenero($genero){
        $this->genero = $genero;
    }
    
    public function getGenero(){
        return $this->genero;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setLogin($login){
        $this->login = $login;
    }
    
    public function getLogin(){
        return $this->login;
    }
    
    public function setSenha($senha){
        $this->senha = $senha;
    }
    
    public function getSenha(){
        return $this->senha;
    }
    
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    
    public function getTelefone(){
        return $this->telefone;
    }

}

?>