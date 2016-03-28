INSERT INTO creche (nome,cnpj,email,telefone1,telefone2,logradouro,numero,bairro,cidade,estado,observacao) 
VALUES ('creche','12123123123412','email@email.com','1212341234','1212341234','rua tal','12b','bairro','cidade','sc','observacao');

insert INTO  pessoafisica  (nome,cpf,rg,email,telefone,celular,dtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao)
VALUES('Carolina',null,null,null,null,null,null,null,null,null,null,null,null,null); 

SELECT max(id_pessoaFisica) into @pf FROM minhacreche.pessoafisica;

INSERT INTO minhacreche.usuario (id_PessoaFisica, login, senha, nivel) VALUES (@pf, 'carolmkl', '123', null);

INSERT INTO minhacreche.funcionario (id_creche, id_pessoaFisica, cargo) VALUES ( 1, @pf, null);

insert INTO  pessoafisica  (nome,cpf,rg,email,telefone,celular,dtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao)
VALUES('Rodrigo',null,null,null,null,null,null,null,null,null,null,null,null,null); 

SELECT max(id_pessoaFisica) into @pf FROM minhacreche.pessoafisica;

INSERT INTO minhacreche.usuario (id_PessoaFisica, login, senha, nivel) VALUES (@pf, 'camargo', '123', null);

INSERT INTO minhacreche.funcionario (id_creche, id_pessoaFisica, cargo) VALUES ( 1, @pf, null);