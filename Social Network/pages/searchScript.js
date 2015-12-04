$(function() {


		$(document).click(function() {
			$("#searchDropdown").css({
 				'opacity' : '0',
 				'pointer-events' : 'none',
 				'z-index' : '1'
 			});
		});

});



$('#searchTextBox').keyup(function() {
  	
  	if($(this).val().length > 0) {
  		
  		$("#searchDropdown").css({
 		'opacity' : '1',
 		'pointer-events' : 'auto',
 		'z-index' : '1'
 		});

 		var text = $('#searchTextBox').val();

   		$("#searchDropdown").load("../templates/searchDropdown.php", {
           text: text
       	});

  	} else {

  		$("#searchDropdown").css({
 		'opacity' : '0',
 		'pointer-events' : 'none',
 		'z-index' : '1'
 		});

  	}

});