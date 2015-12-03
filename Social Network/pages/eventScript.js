
$(document).ready(function(){

	if($("#go").text() == "Going") {

		styleGo();

	} else {

		styleDGo();

	}

});



 $('#go').on('click', function(event){
 		if($("#go").text() != "Going") {
 			styleGo();
 			$("#dgo").text("Don't go");
 			$("#go").text("Going");
 			var eventId = parseFloat($(this).parent().attr('id'));
 			updateAttendance("../actions/addAttendance.php", eventId);
 		}
 });

 $('#dgo').on('click', function(event){
 		if($("#dgo").text() != "Not going") {
 			styleDGo();
 			$("#dgo").text("Not going");
 			$("#go").text("Go");
 			var eventId = parseFloat($(this).parent().attr('id'));
 			updateAttendance("../actions/removeAttendance.php", eventId);
 		}
 });




 function styleDGo() {
 	$("#go").css({
 		'box-shadow' : 'none',
 		'color' : '#467373',
 		'border' : 'solid 1px #172626'
 	});


 	$("#dgo").css({
 		'box-shadow' : '0 0 10px 2px #6AE368',
 		'color' : '#6AE368',
 		'border' : 'solid 1px #6AE368'
 	});

 }


 function styleGo() {
 	$("#go").css({
 		'box-shadow' : '0 0 10px 2px #6AE368',
 		'color' : '#6AE368',
 		'border' : 'solid 1px #6AE368'
 	});

 	$("#dgo").css({
 		'box-shadow' : 'none',
 		'color' : '#467373',
 		'border' : 'solid 1px #172626'
 	});
 }


 function updateAttendance(postPath, eventId) {

 	var email = $('#user').text();

 	var script = $.post(postPath,  {id: eventId, email: email});

 	script.done(function(data) {
      
      	if(data != 'true') {
            swal("Oops...", data, "error");
      	}

   	});

   	script.fail(function() {
      	swal("Oops...", "Error accessing database..", "error");
   	});
 }