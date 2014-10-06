/*global angular */
'use strict';

// create the module and name it negocieApp
var negocieApp = angular.module('negocieApp', [
	'ngRoute',
	'negocieControllers',	
	'Filters',
	'ajoslin.promise-tracker'	
	]);



negocieApp.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;
            
            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                    //scope.uploadFile();
                });
            });
        }
    };
}]);


negocieApp.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl){
        var fd = new FormData();
        fd.append('foto', file);
        
        return $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        });
    };
}]);

  
// configure our routes
negocieApp.config(function($routeProvider) {
	$routeProvider
		// route for the home page
		.when('/', {
			templateUrl : 'pages/home.html',
			controller  : 'mainController'
		})

		// route for the about page
		.when('/about', {
			templateUrl : 'pages/about.html',
			controller  : 'aboutController'
		})

		// route for the contact page
		.when('/contact', {
			templateUrl : 'pages/contact.html',
			controller  : 'contactController'
		})
		
		// route for the anuncie page
		.when('/anuncie', {
			templateUrl : 'pages/anuncie.html',
			controller  : 'anuncioController'
		})
				
		.when('/viewAnuncio', {
			templateUrl : 'pages/viewAnuncio.html',
			controller  : 'viewAnuncioController'
		})
		
		.when('/listaAnuncios', {
			templateUrl : 'pages/listaAnuncio.html',
			controller  : 'listaAnuncioController'
		})
		
		.when('/upload', {
			templateUrl : 'upload/upload.html',
			controller  : 'uploadController'
		});
});