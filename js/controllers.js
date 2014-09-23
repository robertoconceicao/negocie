'use strict';

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

negocieControllers.controller('anuncioController', function($scope, $http, promiseTracker, $timeout) {
	$scope.message = 'Cadastro de anúncio';
	
  	function getCategorias(){  
  		$http.get("ajax/getCategorias.php").success(function(data){
        	$scope.categorias = data;
       });
  	};	
	
	getCategorias();
	
	$scope.anuncio = {};
	$scope.submitAnuncio = function (anuncio, resultVarName){
	  // Default values for the request.
      $scope.progress = promiseTracker('progress');
      
      var config = {
        params: {
          anuncio: anuncio
        },
        tracker : 'progress'
      };

      $http.post("ajax/postAnuncio.php", null, config)
        .success(function (data, status, headers, config)
        { 
          $scope.messages = 'Anúncio cadastrado com sucesso!';
          $scope.error = null;
        })
        .error(function (data, status, headers, config)
        {
        	$scope.messages = null;
            $scope.error = 'Erro ao tentar cadastrar o anúncio.';
        });
    };
    
 // Hide the status message which was set above after n seconds.
    $timeout(function() {
      $scope.messages = null;
      $scope.error = null;
    }, 5000);
});

negocieControllers.controller('estadosController', function($scope, $http) {	 
  	function getEstados(){
  		$http.get("ajax/getEstados.php").success(function(estados){
        	$scope.estados = estados;        	
       });
  	};
  	  	
  	$scope.myEstado = "";
  	$scope.myCidade = "";
  	
  	function getCidades(){
  		$http.get("ajax/getCidades.php",{params: {estado_id: $scope.myEstado.id}}).success(function(cidades){  			
  			$scope.cidades = cidades;
  		});
  	};  	
  	
  	
  	getEstados();
  	getCidades();
});


negocieControllers.controller('listaAnuncioController', function($scope, $http) {
	$scope.page = 1;
	$scope.rows = 10;
	$scope.numberOfPages = 1;
	$scope.pages = null;
	$scope.total = null;
	$scope.anuncios = null;	
	$scope.error = null;
	$scope.message = null;
	
	$scope.listaAnuncio = function (page){
		
		var config = {
	        params: {
	          page: page,
	          rows: $scope.rows
	        }
	      };

		$http.get("ajax/getListaAnuncios.php",config)
			.success(function(data, status, headers, config){
				$scope.anuncios = data.rows;
				$scope.total = data.total;
				$scope.page = data.page;				
				$scope.pages = data.pages;				
				$scope.numberOfPages = data.numberOfPages;				
				$scope.messages = data;
				$scope.error = null;
			})
			.error(function (data, status, headers, config){
				$scope.error = "Erro na listagem";
				$scope.message = null; 
			});
	};	
	
	$scope.changePage = function(numPage){
		$scope.listaAnuncio(numPage);
	}
	
	$scope.prevPage = function(numPage){
	    if($scope.page-1 > 0){	    	
	        $scope.changePage(numPage);
	    }
	}

	$scope.nextPage = function(numPage){
	    if($scope.page+1 <= $scope.numberOfPages){
	        $scope.changePage(numPage);
	    }
	}
	
	// a primeira vez q abre a janela ja chama
	$scope.listaAnuncio(1);
});


negocieControllers.controller('uploadController', function($scope, $http) {
	$scope.fotos = null;
	$scope.cdanuncio = null;
	
	$scope.getFotos = function (cdanuncio){ 
  		var config = {
	        params: {
	          cdanuncio: cdanuncio
	        }
	    };
  		
  		$http.get("upload/getFotos.php", config)
  			.success(function(data, status, headers, config){
	        	$scope.fotos = data.fotos;
	        	$scope.cdanuncio = data.cdanuncio;	        	
	       }).error(function (data, status, headers, config){
				$scope.error = "Erro na ao carregar as fotos";
				$scope.message = null;				
			});
  	};	
	
	
	$scope.submitFoto = function (cdanuncio){
	  
	  formData = $scope.form;


      $http.post("upload/postFoto.php", JSON.stringify(formData))
        .success(function (data, status, headers, config)
        { 
          $scope.messages = 'sucesso!';
          $scope.error = null;
          
          $scope.getFotos();
        })
        .error(function (data, status, headers, config)
        {
        	$scope.messages = null;
            $scope.error = 'Erro ao tentar fazer o upload da foto.';            
        });
    };
    
    $scope.getFotos(1);
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