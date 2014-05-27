// create the module and name it negocieApp
var negocieApp = angular.module('negocieApp', [
	'ngRoute',
	'negocieControllers'
	]);

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
		});
});