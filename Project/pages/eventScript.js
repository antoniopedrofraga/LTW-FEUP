
$(document).ready(function(){


   if ($("#go").text() == "Edit") {

      styleHost();

	} else if ($("#go").text() == "Going") {

		styleGo();

	} else {

		styleDGo();

	}

});

var tdd = new DropDown( $('#type-dd') );
var udd = new DropDown( $('#user-dd') );

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


$('#eventBack').on('click', function(event){
      $(this).css({
         'display' : 'none'
      });

      $('#eventfeed').css({
         'display' : 'none',
      });

});




 $('#go').on('click', function(event){
      if ($("#go").text() == "Edit") {
         
         styleEditEvent();
         return;
      } else if ($("#dgo").text() == "Not going") {
 			styleGo();
 			$("#dgo").text("Don't go");
 			$("#go").text("Going");
 			var eventId = parseFloat($(this).parent().attr('id'));
 			updateAttendance("../actions/addAttendance.php", eventId);
         loadAtInfo();
 		}
 });

 $('#dgo').on('click', function(event){
   if ($("#dgo").text() == "Delete") {
      
      var fd = new FormData();

      var id = parseFloat($('.eventTitle').attr('id'));

      fd.append("id", id);

      $.ajax({
         url: '../actions/removeEvent.php',
         data: fd,
         contentType: false,
         processData: false,
         type: 'POST',
         success: function(data){
            if (data != 'true') {
               swal("Oops...", data, "error");
            } else {
               window.location.replace("../pages/feed.php");
            }
         }
      });
      return;

   } else if ($("#go").text() == "Going") {
     styleDGo();
     $("#dgo").text("Not going");
     $("#go").text("Go");
     var eventId = parseFloat($(this).parent().attr('id'));
     updateAttendance("../actions/removeAttendance.php", eventId);
     loadAtInfo();
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
 		'color' : '#467373',
 		'border' : 'solid 1px #6AE368'
 	});

   $(".commentForm").css({
      'display' : 'none'
   });

 }


 function styleGo() {
 	$("#go").css({
 		'box-shadow' : '0 0 10px 2px #6AE368',
 		'color' : '#467373',
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


 function styleHost() {

   $("#go").css({
      'box-shadow' : 'none',
      'color' : '#467373',
      'border' : 'solid 1px #172626'
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


$( document ).ready(function() {
   loadAtInfo();
});



function loadAtInfo() {
   var id = parseFloat($('.eventTitle').attr('id'));
   $(".attendanceInfo").load("../templates/eventAt.php", {
           id: id
   }, function( response, status, xhr ) {
      if ( status == "error" ) {
         var msg = "Sorry but there was an error loading attendance info: ";
         swal("Oops..", msg + xhr.status + " " + xhr.statusText, "error");
      }
   });
}


function styleEditEvent() {
   $('#eventBack').css({
         'display' : 'block',
   });

   $('#eventfeed').css({
         'display' : 'block',
   });

   var name = $('.eventTitle .title').text();
   var description = $('.description a').text();
   var id = parseFloat($('.eventTitle').attr('id'));
   var date = $('.eventDate #date').text();
   var time = $('.eventDate #time').text();
   var type = $('.eventTitle .icon').attr('id');
   var image = $('.eventTitle .icon').attr('src');

   var year = date[6] + date[7] + date[8] + date[9];
   var month = date[3] + date[4];
   var day = date[0] + date[1];

   var properlyFormatted = year + "-" + month + "-" + day;

   if(time.length == 4) time = '0' + time;

   $('#nameTextBox').val(name);
   $('#eventTextBox').val(description);

   $('#type-dd span').text(type);
   $('#event-date').val(properlyFormatted);
   $('#event-hour').val(time);

}

$('#loutForm').hover(function(){
    $('#user-dd').css({
      'opacity' : '1',
      'pointer-events' : 'auto',
      'z-index' : '1'
   });
}, function(){
    $('#user-dd').css({
      'opacity' : '0',
      'pointer-events' : 'none',
      'z-index' : '1'
   });
})

$('.delete').on('click', function(event){

   var id = $(this).attr('id');


   var fd = new FormData();

   fd.append("id", id);

   $.ajax({
      url: '../actions/removeComment.php',
      data: fd,
      contentType: false,
      processData: false,
      type: 'POST',
      success: function(data){
         if(data == 'true') {
            location.reload();
         } else {
            swal("Oops...", data, "error");
         }
      }
   });
});


