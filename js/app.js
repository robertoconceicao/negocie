/*global angular */
'use strict';

// create the module and name it negocieApp
var negocieApp = angular.module('negocieApp', [
	'ngRoute',
	'negocieControllers',
	'flow',
	'Filters'
	]);

negocieApp.config(['flowFactoryProvider', function (flowFactoryProvider) {
    flowFactoryProvider.defaults = {
      target: '',
      permanentErrors: [500, 501],
	  
      maxChunkRetries: 1,
      chunkRetryInterval: 5000,
      simultaneousUploads: 1
    };
    flowFactoryProvider.on('catchAll', function (event) {
      console.log('catchAll', arguments);
    });
    // Can be used with different implementations of Flow.js
    flowFactoryProvider.factory = fustyFlowFactory;
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
		});
});