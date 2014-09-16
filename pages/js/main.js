/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

cdpasta = null;

$(function () {
    'use strict';    
    
    var url = window.location.href.toString();    
	debugger;
    if(url.indexOf("cdpasta") > -1){
    	cdpasta = url.split("=")[1];    	
    }
    console.log(url);
        
    if(cdpasta === null || cdpasta === ""){
    	var url = 'server/php/dao/pastaAction.php';
		
		$.post(url,{metodo: "geraCodigoPasta"},'json')
		.done( function(result){
			var data = eval("(" + result + ")");				
			cdpasta = data.cdpasta;
		})
		.fail(function() {
		    alert( 'Erro ao tentar gerarCodigo' );
		});		
    }
    
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},    	
        url: 'server/php/index.php?cdpasta='+cdpasta
    });
    
    // Load existing files:	
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        data: {'cdpasta': cdpasta},
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
    });
});