var negocieControllers = angular.module('negocieControllers', []);

// create the controller and inject Angular's $scope
negocieControllers.controller('mainController', function($scope) {
	// create a message to display in our view
	$scope.message = 'Everyone come and see how good I look!';
});

negocieControllers.controller('aboutController', function($scope) {
	$scope.message = 'Look! I am an about page.';
});

negocieControllers.controller('contactController', function($scope) {
	$scope.message = 'Contact us! JK. This is just a demo.';
});

negocieControllers.controller('anuncioController', function($scope, $http) {
	$scope.message = 'Cadastro de anúncio';
	
//	getCategorias(); // Load all available categorias 
  	function getCategorias(){  
  		$http.get("ajax/getCategorias.php").success(function(data){
        	$scope.categorias = data;
       });
  	};	
	
	getCategorias();
});

/*
negocieControllers.controller('PhoneListCtrl', ['$scope', '$http',
  function ($scope, $http) {
    $http.get('phones/phones.json').success(function(data) {
      $scope.phones = data;
    });

    $scope.orderProp = 'age';
  }]);

negocieControllers.controller('PhoneDetailCtrl', ['$scope', '$routeParams', '$http',
  function($scope, $routeParams, $http) {
	$http.get('phones/'+$routeParams.phoneId+'.json').success(
		function(data){
			$scope.phone = data;
		}
	);    
  }]);
*/