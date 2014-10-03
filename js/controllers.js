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

negocieControllers.controller('anuncioController', ['$scope', '$http','fileUpload', 'promiseTracker', '$timeout', function($scope, $http, $fileUpload, $promiseTracker, $timeout) {
	$scope.message = 'Cadastro de anúncio';
	$scope.anuncio = {};
	$scope.fotos = [];
	$scope.cdanuncio = null;
	$scope.hashcode = null;
	$scope.status = "I";	
	$scope.debug = null;
	
  	function getCategorias(){  
  		$http.get("ajax/getCategorias.php").success(function(data){
        	$scope.categorias = data;
       });
  	};	
	
	getCategorias();
	
	$scope.submitAnuncio = function (anuncio, resultVarName){
	  // Default values for the request.
      $scope.progress = $promiseTracker('progress');
      
      var config = {
        params: {
          anuncio: anuncio,
          fotos: JSON.stringify($scope.fotos)
        },
        tracker : 'progress'
      };

      $http.post("ajax/postAnuncio.php", null, config)      	
        .success(function (data, status, headers, config)
        { console.log('Config: '+JSON.stringify(config));
          $scope.messages = config;//null;//'Anúncio cadastrado com sucesso!';
          $scope.error = null;
          console.log(data);
        })
        .error(function (data, status, headers, config)
        {
        	$scope.messages = null;
            $scope.error = 'Erro ao tentar cadastrar o anúncio.';
            console.log('Erro: '+data);
        });
    };
    
 // esta sendo utilizado o service fileUpload criado no app.js
//    negocieControllers.controller('uploadController', ['$scope', '$http','fileUpload', function($scope, $http, $fileUpload){
		
	$scope.uploadFile = function(){
        var file = $scope.myFile;
        console.log('file is ' + JSON.stringify(file));
        var uploadUrl = "upload/postFoto.php?cdanuncio="+$scope.cdanuncio+"&status="+$scope.status;
        
        $fileUpload.uploadFileToUrl(file, uploadUrl)
        .success(function(result){
        	console.log(result);
            $scope.myFile = null;
            if(result.nmfoto != null){
            	$scope.fotos.push(result.nmfoto);            	
            }
            //$scope.getFotos($scope.cdanuncio, $scope.status);
        })
        .error(function(result){
        	$scope.messages = null;
        	$scope.myFile = null;
            $scope.error = 'Erro ao tentar fazer o upload da foto.';
            console.log('Erro: '+result);
        });
    };	    
	
	$scope.getFotos = function (cdanuncio, status){ 
  		var config = {
	        params: {
	          cdanuncio: cdanuncio,
	          status: status
	        }
	    };
  		
  		$http.get("upload/getFotos.php", config)
  			.success(function(data, status, headers, config){
	        	$scope.fotos = data.fotos;
	        	//$scope.cdanuncio = data.cdanuncio;	        	
	        	//$scope.hashcode = data.hashcode;
	        	//$scope.status = data.status;	        	
	       }).error(function (data, status, headers, config){
				$scope.error = "Erro na ao carregar as fotos";
				$scope.message = null;				
			});
  	};
  	
  	// Remove uma foto do servidor pelo nmfoto se o status for igual a I entao 
  	// remove do dir_tmp senao do dir_fotos e db
  	$scope.removeFoto = function (cdanuncio, status, nmfoto, index){
  		var config = {
	        params: {
	          cdanuncio: cdanuncio,
	          status: status,
	          nmfoto: nmfoto
	        }
	    };
  		$http.get("upload/removeFoto.php", config)
  			.success(function(data, status, headers, config){
  				$scope.fotos.splice(index,1);
  				//data.nmfoto;
  				//$scope.getFotos($scope.cdanuncio, $scope.status);
	       }).error(function (data, status, headers, config){
	    	   $scope.error = data.msg;
	    	   //$scope.getFotos($scope.cdanuncio, $scope.status);				
		   });
  	};
        
      	//$scope.getFotos($scope.cdanuncio, $scope.status);
 //   }]);
    
    
    
 // Hide the status message which was set above after n seconds.
    $timeout(function() {
      $scope.messages = null;
      $scope.error = null;
    }, 5000);
}]);

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

/*
 * 
 *Exemplos de controles 
 *
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