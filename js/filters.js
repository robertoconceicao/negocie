'use strict';

/* Filters 
 * exemplo: http://stackoverflow.com/questions/11996857/how-to-use-parameters-within-the-filter-in-angularjs
 * 
 * */

angular.module('Filters', []).filter('cidades', function() {
  return function(input, estado) {	  
	  var out = [];
	  if(input && estado){
		  for (var i = 0; i < input.length; i++){
			  if(input[i].estado == estado.id){
				  out.push(input[i]);        	  
			  }
		  }
	  }
      return out;
  };
});