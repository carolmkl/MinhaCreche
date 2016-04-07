(function () {
    'use strict';

    function crecheCtrl($scope, $http) {
        function getCreche() {
            $http.post("./../code/crecheGet.php").success(function (data) {
				$scope.id_creche = data[0].id_creche;
				$scope.nome = data[0].nome;
				$scope.cnpj = data[0].cnpj;
				$scope.email = data[0].email;
				$scope.telefone1 = data[0].telefone1;
				$scope.telefone2 = data[0].telefone2;
				$scope.logradouro = data[0].logradouro;
				$scope.numero = data[0].numero;
				$scope.bairro = data[0].bairro;
				$scope.cidade = data[0].cidade;
				$scope.estado = data[0].estado;
				$scope.observacao = data[0].observacao;
            });
		}
        getCreche();

			

        $scope.updateCreche = function () {
            $http.post("./../code/crecheUpdate.php?id_creche=" + $scope.id_creche + "&nome=" + $scope.nome + "&cnpj=" + $scope.cnpj + "&email=" + $scope.email + "&telefone1=" + $scope.telefone1 + "&telefone2=" + $scope.telefone2 + "&logradouro=" + $scope.logradouro + "&numero=" + $scope.numero + "&bairro=" + $scope.bairro + "&cidade=" + $scope.cidade + "&estado=" + $scope.estado + "&observacao=" + $scope.observacao).success(function (data) {
                alert("Sucesso!");
                getCreche();
            });
        };
    }


    function funcionarioListCtrl($scope, $http) {

		function listFuncionarios() {
            $http.post("./../code/funcionarioList.php").success(function (data) {
				$scope.funcionarios = data;
			});
		}
        
        listFuncionarios();

		$scope.deleteFuncionario = function (id_funcionario, id_pessoafisica) {
			$http.post("./../code/funcionarioDelete.php?id_funcionario=" + id_funcionario+"&id_pessoaFisica="+id_pessoafisica).success(function (data) {
				listFuncionarios();
			});
		};

		$scope.openModalAddFuncionario = function (size, options, index) {
            $scope.modalCourse = $modal.open({
                templateUrl: 'MinhaCreche/design/funcionario_modal.php',
                controller: modalAddFuncionario,
                scope: $scope,
                size: size,
                backdrop: true,
                keyboard: false,
                resolve: {
                    ModalOptions: function () {
                        return [options, index];
                    }
                }
            });
        };
    }

    function funcionarioCtrl($scope, $http, $stateParams) {

		function init() {
			if ($stateParams.id_funcionario) {
				$scope.id_funcionario = $stateParams.id_funcionario;
				getFuncionario($scope.id_funcionario);
			}else{

			}
			getFuncionario(4);
		}
        
        init();
        
        function getFuncionario(id_funcionario) {
			alert("getFuncionario="+id_funcionario);
			
			$scope.id_funcionario = 0;
			$scope.id_pessoafisica = 0;

			$http.post("./../code/funcionarioGet.php?id_funcionario=" + $scope.id_funcionario).success(function (data) {
                alert("Entrou no getFuncionario " + data[0].id_funcionario);
                $scope.funcionario = data;
            });
		}

		$scope.salvaFuncionario = function (login, senha, nome, cpf, rg, email, telefone, celular, ndtNascimento, genero, logradouro, numero, bairro, cidade, estado, observacao, cargo) {
			alert("salvarFuncionario");
            if ($scope.funcionario.id_funcionario == 0) {
				insertFuncionario(login, senha, nome, cpf, rg, email, telefone, celular, ndtNascimento, genero, logradouro, numero, bairro, cidade, estado, observacao, cargo);
            } else {
				updateFuncionario(login, senha, nome, cpf, rg, email, telefone, celular, ndtNascimento, genero, logradouro, numero, bairro, cidade, estado, observacao, cargo);
            }
			window.location.replace("funcionarios.php");
		};

		$scope.updateFuncionario = function (login, senha, nome, cpf, rg, email, telefone, celular, ndtNascimento, genero, logradouro, numero, bairro, cidade, estado, observacao, cargo) {
			alert("updateFuncionario");
			$http.post("./../code/funcionarioUpdate.php?id_funcionario=" + $scope.id_funcionario + "&id_pessoafisica=" + $scope.id_pessoafisica + "&nome=" + $scope.nome + "&cpf=" + $scope.cpf + "&rg=" + $scope.rg + "&email=" + $scope.email + "&telefone=" + $scope.telefone + "&celular=" + $scope.celular + "&dtNascimento=" + $scope.dtNascimento + "&genero=" + $scope.genero + "&logradouro=" + $scope.logradouro + "&numero=" + $scope.numero + "&bairro=" + $scope.bairro + "&cidade=" + $scope.cidade + "&estado=" + $scope.estado + "&observacao=" + $scope.observacao + "&cargo=" + $scope.cargo).success(function (data) {
                alert("Sucesso!");
			});
		};

		$scope.insertFuncionario = function (login, senha, nome, cpf, rg, email, telefone, celular, ndtNascimento, genero, logradouro, numero, bairro, cidade, estado, observacao, cargo) {
			alert("insertFuncionario");
			$http.post("./../code/funcionarioInsert.php?id_funcionario=" + $scope.id_funcionario + "&id_pessoafisica=" + $scope.id_pessoafisica + "&nome=" + $scope.nome + "&cpf=" + $scope.cpf + "&rg=" + $scope.rg + "&email=" + $scope.email + "&telefone=" + $scope.telefone + "&celular=" + $scope.celular + "&dtNascimento=" + $scope.dtNascimento + "&genero=" + $scope.genero + "&logradouro=" + $scope.logradouro + "&numero=" + $scope.numero + "&bairro=" + $scope.bairro + "&cidade=" + $scope.cidade + "&estado=" + $scope.estado + "&observacao=" + $scope.observacao + "&cargo=" + $scope.cargo + "&login=" + $scope.login + "&senha=" + $scope.senha).success(function (data) {
                alert("Sucesso!");
			});
		};

		//id_pessoafisica,nome,cpf,rg,email,telefone,celular,dtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao
    }


    angular.module('minhaCrecheApp', [])
			.controller('crecheCtrl', crecheCtrl)
			.controller('funcionarioListCtrl', funcionarioListCtrl)
			.controller('funcionarioCtrl', funcionarioCtrl)
			/*.config(['$stateParams', function($stateParams) {
            $stateParams.
            when('/f/:id_funcionario', {
            templateUrl: 'funcionario_modal.php',
            controller: 'funcionarioCtrl'
            });
            }])*/
			;

    crecheCtrl.$inject = ['$scope', '$http'];
    funcionarioListCtrl.$inject = ['$scope', '$http'];
    funcionarioCtrl.$inject = ['$scope', '$http'];

}());

