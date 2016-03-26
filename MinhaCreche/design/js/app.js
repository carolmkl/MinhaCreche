var app = angular.module('minhaCrecheApp', []);

app.controller('crecheCtrl', function($scope, $http) {
	getCreche(); // Load all available tasks 
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

	$scope.updateCreche = function(vid_creche,vnome,vcnpj,vemail,vtelefone1,vtelefone2,vlogradouro,vnumero,vbairro,vcidade,vestado,vobservacao) {
	

		$http.post("./../code/crecheUpdate.php?id_creche="+vid_creche+"&nome="+vnome+"&cnpj="+vcnpj+"&email="+vemail
			+"&telefone1="+vtelefone1+"&telefone2="+vtelefone2+"&logradouro="+vlogradouro+"&numero="+vnumero+"&bairro="+vbairro
			+"&cidade="+vcidade+"&estado="+vestado+"&observacao="+vobservacao).success(function(data){
				getCreche();
			});
	};

});


app.controller('funcionarioListCtrl', function($scope, $http) {
	listFuncionarios(); // Load all available tasks 
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

});


app.controller('funcionarioCtrl', function($scope, $http) {
	$scope.init = function(){
		if(!isset($_GET['a'])){
			$scope.id_funcionario = $_GET['a'];
			$scope.id_pessoafisica = $_GET['b'];
			getFuncionario($scope.id_funcionario)
		}
	};

	$scope.id_funcionario
	getFuncionario($scope.id_funcionario);

 function getFuncionario(id_funcionario){  
	$http.post("./../code/funcionarioGet.php?id_funcionario="+id_funcionario).success(function(data){
				$scope.id_funcionario = data[0].id_funcionario;
				$scope.id_pessoafisica = data[0].id_pessoafisica;
				$scope.nome = data[0].nome;
				$scope.cpf = data[0].cnpj;
				$scope.rg = data[0].cnpj;
				$scope.email = data[0].email;
				$scope.telefone = data[0].telefone1;
				$scope.celular = data[0].telefone2;
				$scope.dtNascimento = data[0].telefone2;
				$scope.genero = data[0].telefone2;
				$scope.logradouro = data[0].logradouro;
				$scope.numero = data[0].numero;
				$scope.bairro = data[0].bairro;
				$scope.cidade = data[0].cidade;
				$scope.estado = data[0].estado;
				$scope.observacao = data[0].observacao;
			 });
	};

	function salvaFuncionario(){};

	$scope.updateFuncionario = function(id_creche,vnome,vcnpj,vemail,vtelefone1,vtelefone2,vlogradouro,vnumero,vbairro,vcidade,vestado,vobservacao) {
		$http.post("./../code/funcionarioUpdate.php?id_creche="+vid_creche+"&nome="+vnome+"&cnpj="+vcnpj+"&email="+vemail
			+"&telefone1="+vtelefone1+"&telefone2="+vtelefone2+"&logradouro="+vlogradouro+"&numero="+vnumero+"&bairro="+vbairro
			+"&cidade="+vcidade+"&estado="+vestado+"&observacao="+vobservacao).success(function(data){
				listFuncionarios();
			});
	};

	$scope.insertFuncionario = function(vnome,vcnpj,vemail,vtelefone1,vtelefone2,vlogradouro,vnumero,vbairro,vcidade,vestado,vobservacao) {
		$http.post("./../code/funcionarioUpdate.php?id_creche="+vid_creche+"&nome="+vnome+"&cnpj="+vcnpj+"&email="+vemail
			+"&telefone1="+vtelefone1+"&telefone2="+vtelefone2+"&logradouro="+vlogradouro+"&numero="+vnumero+"&bairro="+vbairro
			+"&cidade="+vcidade+"&estado="+vestado+"&observacao="+vobservacao).success(function(data){
				listFuncionarios();
			});
	};

function deleteFuncionario(id_funcionario){  
	$http.post("./../code/funcionarioGet.php?id_funcionario="+id_funcionario).success(function(data){
				listFuncionarios();
			 });
	};

});