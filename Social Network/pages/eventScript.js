
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

   $(".commentForm").css({
      'display' : 'none'
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

   $(".commentForm").css({
      'display' : 'block'
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


$('#commentButton').on('click', function(event){

      var textBox = document.getElementById('commentTextBox');
      var eventId = parseFloat($('.eventTitle').attr('id'));
      var email = $('#user').text();

      onOk(textBox);
      
      if(textBox.value == '') {
         onError(textBox);
      }

      var fd = new FormData();

      fd.append("email", email);
      fd.append("id", eventId);
      fd.append("text", textBox.value);


      $.ajax({
         url: '../actions/addComment.php',
         data: fd,
         contentType: false,
         processData: false,
         type: 'POST',
         success: function(data){
         if(data != 'true') {
               swal("Oops...", data, "error");
         } else {
               $("#commentTextBox").text("");
               location.reload();
         }
        }
      });
 });

function onError(element) {
   element.style.borderColor = 'red';
   element.style.backgroundColor = '#FFDEDE';
}

function onOk(element) {
   element.style.borderColor = 'gray';
   element.style.backgroundColor = 'white';
}
