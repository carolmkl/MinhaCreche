(function () {
    'use strict';

    function crecheCtrl($scope, $http){

			getCreche();

			function getCreche(){  
				$http.post("./../code/crecheGet.php").success(function(data){
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
			};

			$scope.updateCreche = function() {
				$http.post("./../code/crecheUpdate.php?id_creche="+$scope.id_creche+"&nome="+$scope.nome+"&cnpj="+$scope.cnpj+"&email="+$scope.email+"&telefone1="+$scope.telefone1+"&telefone2="+$scope.telefone2+"&logradouro="+$scope.logradouro+"&numero="+$scope.numero+"&bairro="+$scope.bairro+"&cidade="+$scope.cidade+"&estado="+$scope.estado+"&observacao="+$scope.observacao).success(function(data){
						alert("Sucesso!");
						getCreche();
				});
			};
    };


    function funcionarioListCtrl($scope, $http){
			
		listFuncionarios(); 

		function listFuncionarios(){
		 $http.post("./../code/funcionarioList.php").success(function(data){
				 $scope.funcionarios = data;
			});
		};

		$scope.deleteFuncionario = function(id_funcionario,id_pessoafisica){  
			$http.post("./../code/funcionarioDelete.php?id_funcionario="+id_funcionario).success(function(data){
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
    };

    function funcionarioCtrl($scope, $http,$RouteProvider){

    	//$scope.id_funcionario = $RouteProvider.id_funcionario;

		function init(){
			if ($RouteProvider.id_funcionario) {
				$scope.id_funcionario = $RouteProvider.id_funcionario;
				getFuncionario($scope.id_funcionario);
			}else{

			}
		};

		function getFuncionario(id_funcionario){  
			alert("getFuncionario="+id_funcionario);
			
			$scope.id_funcionario = 0;
			$scope.id_pessoafisica = 0;

			$http.post("./../code/funcionarioGet.php?id_funcionario="+$scope.id_funcionario).success(function(data){
					alert("Entrou no getFuncionario " + data[0].id_funcionario);
					$scope.funcionario = data[0];
				 });
		};

		$scope.salvaFuncionario = function(){
				if($scope.funcionario.id_funcionario = 0){
					insertFuncionario();
				}else{
					updateFuncionario();
				}
				window.location.replace("funcionarios.php");
		};

		$scope.updateFuncionario = function() {
			$http.post("./../code/funcionarioUpdate.php?id_funcionario="+$scope.id_funcionario+"&id_pessoafisica="+$scope.id_pessoafisica+"&nome="+$scope.nome+"&cpf="+$scope.cpf+"&rg="+$scope.rg+"&email="+$scope.email+"&telefone="+$scope.telefone+"&celular="+$scope.celular+"&dtNascimento="+$scope.dtNascimento+"&genero="+$scope.genero+"&logradouro="+$scope.logradouro+"&numero="+$scope.numero+"&bairro="+$scope.bairro+"&cidade="+$scope.cidade+"&estado="+$scope.estado+"&observacao="+$scope.observacao+"&cargo="+$scope.cargo).success(function(data){
					alert("Sucesso!");
			});
		};

		$scope.insertFuncionario = function() {
			$http.post("./../code/funcionarioInsert.php?id_funcionario="+$scope.id_funcionario+"&id_pessoafisica="+$scope.id_pessoafisica+"&nome="+$scope.nome+"&cpf="+$scope.cpf+"&rg="+$scope.rg+"&email="+$scope.email+"&telefone="+$scope.telefone+"&celular="+$scope.celular+"&dtNascimento="+$scope.dtNascimento+"&genero="+$scope.genero+"&logradouro="+$scope.logradouro+"&numero="+$scope.numero+"&bairro="+$scope.bairro+"&cidade="+$scope.cidade+"&estado="+$scope.estado+"&observacao="+$scope.observacao+"&cargo="+$scope.cargo+"&login="+$scope.login+"&senha="+$scope.senha).success(function(data){
					alert("Sucesso!");
			});
		};

		//id_pessoafisica,nome,cpf,rg,email,telefone,celular,dtNascimento,genero,logradouro,numero,bairro,cidade,estado,observacao
		init();
    };


		angular.module('minhaCrecheApp', ['ngRoute'])
			.controller('crecheCtrl',crecheCtrl)
			.controller('funcionarioListCtrl',funcionarioListCtrl)
			.config(['$RouteProvider', function($RouteProvider) {
		    	$route.RouteProvider.
		      when('/f/:id_funcionario', {
		        templateUrl: 'funcionario_modal.php',
		        controller: 'funcionarioCtrl'
		      });
		   	}])
			.controller('funcionarioCtrl',['$scope','$route',funcionarioCtrl])
			;

		//crecheCtrl.$inject = ['$scope', '$http'];
		//funcionarioListCtrl.$inject = ['$scope', '$http'];
		//funcionarioCtrl.$inject = ['$scope', '$http','$$route'];

}());

