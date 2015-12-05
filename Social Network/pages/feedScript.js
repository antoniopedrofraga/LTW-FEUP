var pdd = new DropDown( $('#privacy-dd') );
var tdd = new DropDown( $('#type-dd') );

$('.privacy-div').on('click', function(event){
		$('.dropdown-div').removeClass('active');
		$(this).toggleClass('active');
		return false;
});

	//...

$(function() {


		$(document).click(function() {
			$('.dropdown-div').removeClass('active');
		});

});



 $('.going').on('click', function(event){
 	var status = $(this).parent().parent().find($('h1.status'));

 	var eventId = parseFloat($(this).parent().parent().attr('id'));

 	var email = $('#user').text();


 	if($(this).val() == "Go") {
 		$(this).val("Don't Go");
 		status.text("Going");
 		var postPath = "../actions/addAttendance.php";
 	} else {
 		$(this).val("Go");
 		status.text("Not Going");
 		var postPath = "../actions/removeAttendance.php"
 	}

 	var script = $.post(postPath,  {id: eventId, email: email});

 	script.done(function(data) {
      
      	if(data != 'true') {
            swal("Oops...", data, "error");
      	}

   	});

   	script.fail(function() {
      	swal("Oops...", "Error accessing database..", "error");
   	});

});







