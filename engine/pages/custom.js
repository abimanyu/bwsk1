(function( $ ) {
	
	'use strict';

	//decodeHTMLEntities
	var decodeEntities = (function() {
	var element = document.createElement('div');

	function decodeHTMLEntities (str) {
	    if(str && typeof str === 'string') {
	      str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
	      str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
	      element.innerHTML = str;
	      str = element.textContent;
	      element.textContent = '';
	    }

	    return str;	
	}

	  return decodeHTMLEntities;
	})();
	
	//AUTO COMPLETE customer
	$(function() {
		$("#customer").autocomplete({
			source: "../ajax.php?ac=customer&",
			minLength: 2, 
			focus: function( event, ui ) {
	           $( "#customer" ).val( decodeEntities( ui.item.nama ));
	              return false;
	           },
	    select: function( event, ui ) {
	       $( "#customer" ).val( decodeEntities( ui.item.nama ));
	       $( "#customer_id" ).val( decodeEntities( ui.item.CID ));
	       $( "#corp" ).val( decodeEntities( ui.item.corp ));
	       $( "#alamat" ).val( decodeEntities( ui.item.alamat ));
	       return false;
	    } 
	  }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			return $( "<li class='btn-link'>" )
			.append( "<a><span class='text-tertiary'>" + item.nama + "</span> <span class='text-muted'>" +item.corp +"</span></a>" )
			.appendTo( ul );
		};
	});

}).apply( this, [ jQuery ]);