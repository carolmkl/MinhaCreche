CREATE DATABASE MinhaCreche;

CREATE TABLE PessoaFisica (
  id_pessoaFisica INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NULL,
  nrResidencia INTEGER UNSIGNED NULL,
  complemento VARCHAR(60) NULL,
  telefone VARCHAR(20) NULL,
  celular VARCHAR(20) NULL,
  email VARCHAR(255) NULL,
  genero CHAR(1) NULL,
  dtNascimento DATE NULL,
  rg VARCHAR(20) NULL,
  cpf VARCHAR(20) NULL,
  PRIMARY KEY(id_pessoaFisica)
);

CREATE TABLE Creche (
  id_creche INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NULL,
  nomeFantasia VARCHAR(255) NULL,
  nrResidencia INTEGER UNSIGNED NULL,
  complemento VARCHAR(20) NULL,
  telefone VARCHAR(20) NULL,
  email VARCHAR(60) NULL,
  cnpj VARCHAR(20) NULL,
  url VARCHAR(60) NULL,
  PRIMARY KEY(id_creche)
);

CREATE TABLE Turma (
  id_turma INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_creche INTEGER UNSIGNED NOT NULL,
  apelido VARCHAR(60) NULL,
  sala VARCHAR(10) NULL,
  descricao VARCHAR(60) NULL,
  horarioInicio TIME NULL,
  horarioFim TIME NULL,
  PRIMARY KEY(id_turma),
  INDEX Turma_FKIndex1(id_creche),
  FOREIGN KEY(id_creche)
    REFERENCES Creche(id_creche)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Responsavel (
  id_responsavel INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_pessoaFisica INTEGER UNSIGNED NOT NULL,
  profissao VARCHAR(60) NULL,
  foneComercial VARCHAR(20) NULL,
  PRIMARY KEY(id_responsavel),
  INDEX Responsavel_FKIndex1(id_pessoaFisica),
  FOREIGN KEY(id_pessoaFisica)
    REFERENCES PessoaFisica(id_pessoaFisica)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Feriados (
  id_feriados INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_creche INTEGER UNSIGNED NOT NULL,
  dtinicio DATE NULL,
  dtFim DATE NULL,
  motivo VARCHAR(60) NULL,
  PRIMARY KEY(id_feriados),
  INDEX Feriados_FKIndex1(id_creche),
  FOREIGN KEY(id_creche)
    REFERENCES Creche(id_creche)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Crianca (
  id_crianca INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_creche INTEGER UNSIGNED NOT NULL,
  nome VARCHAR(255) NULL,
  genero CHAR(1) NULL,
  dtNascimento DATE NULL,
  obs TEXT NULL,
  PRIMARY KEY(id_crianca),
  INDEX Crianca_FKIndex1(id_creche),
  FOREIGN KEY(id_creche)
    REFERENCES Creche(id_creche)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE usuario (
  id_usuario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_PessoaFisica INTEGER UNSIGNED NOT NULL,
  login VARCHAR(255) NULL,
  senha VARCHAR(255) NULL,
  nivel VARCHAR(10) null,
  PRIMARY KEY(id_usuario),
  INDEX usuario_FKIndex1(id_PessoaFisica),
  FOREIGN KEY(id_PessoaFisica)
    REFERENCES PessoaFisica(id_PessoaFisica)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Turma_has_Crianca (
  id_turma INTEGER UNSIGNED NOT NULL,
  id_crianca INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(id_turma, id_crianca),
  INDEX Turma_has_Crianca_FKIndex1(id_turma),
  INDEX Turma_has_Crianca_FKIndex2(id_crianca),
  FOREIGN KEY(id_turma)
    REFERENCES Turma(id_turma)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(id_crianca)
    REFERENCES Crianca(id_crianca)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE ResponsavelCrianca (
  id_responsavel INTEGER UNSIGNED NOT NULL,
  id_crianca INTEGER UNSIGNED NOT NULL,
  parentesco VARCHAR(20) NULL,
  PRIMARY KEY(id_responsavel, id_crianca),
  INDEX Responsavel_has_Crianca_FKIndex1(id_responsavel),
  INDEX Responsavel_has_Crianca_FKIndex2(id_crianca),
  FOREIGN KEY(id_responsavel)
    REFERENCES Responsavel(id_responsavel)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(id_crianca)
    REFERENCES Crianca(id_crianca)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Aviso (
  id_Aviso INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_pessoaFisica INTEGER UNSIGNED NOT NULL,
  id_crianca INTEGER UNSIGNED NOT NULL,
  tx_mensagem TEXT NULL,
  nivel TINYINT UNSIGNED NULL,
  dataEntrega DATE NULL,
  PRIMARY KEY(id_Aviso),
  INDEX Aviso_FKIndex1(id_crianca),
  INDEX Aviso_FKIndex2(id_pessoaFisica),
  FOREIGN KEY(id_crianca)
    REFERENCES Crianca(id_crianca)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(id_pessoaFisica)
    REFERENCES PessoaFisica(id_pessoaFisica)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Funcionario (
  id_Funcionario INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  id_creche INTEGER UNSIGNED NOT NULL,
  id_pessoaFisica INTEGER UNSIGNED NOT NULL,
  cargo VARCHAR(60) NOT NULL,
  PRIMARY KEY(id_Funcionario),
  INDEX Funcionario_FKIndex1(id_pessoaFisica),
  INDEX Funcionario_FKIndex2(id_creche),
  FOREIGN KEY(id_pessoaFisica)
    REFERENCES PessoaFisica(id_pessoaFisica)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(id_creche)
    REFERENCES Creche(id_creche)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE Destinatario (
  id_Aviso INTEGER UNSIGNED NOT NULL,
  id_pessoaFisica INTEGER UNSIGNED NOT NULL,
  dtLido  DATE NULL,
  PRIMARY KEY(id_Aviso, id_pessoaFisica),
  INDEX Aviso_has_PessoaFisica_FKIndex1(id_Aviso),
  INDEX Aviso_has_PessoaFisica_FKIndex2(id_pessoaFisica),
  FOREIGN KEY(id_Aviso)
    REFERENCES Aviso(id_Aviso)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(id_pessoaFisica)
    REFERENCES PessoaFisica(id_pessoaFisica)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);

CREATE TABLE PedagogoTurma (
  id_turma INTEGER UNSIGNED NOT NULL,
  id_funcionario INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(id_turma,id_funcionario),
  INDEX PedagogoTurma_FKIndex1(id_turma),
  INDEX PedagogoTurma_FKIndex2(id_funcionario),
  FOREIGN KEY(id_funcionario)
    REFERENCES Funcionario(id_funcionario)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  FOREIGN KEY(id_turma)
    REFERENCES Turma(id_turma)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
);


