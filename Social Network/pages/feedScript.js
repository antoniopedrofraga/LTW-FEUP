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


document.getElementById('crtEvent').onclick = function() {
	
	var name = document.getElementById('nameTextBox');
	var description = document.getElementById('eventTextBox');
	var privacy = document.getElementById('privacy-span').textContent;
	var type = document.getElementById('type-span');
	var date = document.getElementById('event-date');
	var hour = document.getElementById('event-hour');

	onOk(name);
	onOk(description);
	onOk(type);
	onOk(date);
	onOk(hour);

	if (name.value == '') {
		onError(name);
		return false;
	} else if (description.value == '') {
		onError(description);
		return false;
	} else if (type.textContent == 'Type') {
		onError(type);
		return false;
	} else if (date.value == '') {
		onError(date);
		return false;
	} else if (hour.value == '') {
		onError(hour);
		return false;
	} else if (document.getElementById('file-to-upload').value == '') {
		onError(document.getElementById('addPhotos'));
		return false;
	}

	var fd = new FormData();
    var file_data = $('#file-to-upload')[0].files[0];

    fd.append("fileToUpload", file_data);
    fd.append("eventName", name.value);
    fd.append("eventDescription", description.value);
    fd.append("eventPrivacy", privacy);
    fd.append("eventType", type.textContent);
    fd.append("eventDate", date.value);
    fd.append("eventTime", hour.value);

	$.ajax({
        url: '../actions/upload.php',
        data: fd,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function(data){
        	if(data != 'true') {
            	swal("Oops...", data, "error");
        	} else {
        		location.reload();
        	}
        }
    });

	return false;
}

function onError(element) {
	element.style.borderColor = 'red';
	element.style.backgroundColor = '#FFDEDE';
}

function onOk(element) {
	element.style.borderColor = '#E2E2E2';
	element.style.backgroundColor = 'white';
}




$('.add-photos').on('click', function(event){
		$('#file-to-upload').click();
		return true;
});


 $("#file-to-upload").change(function() {
        var fullPath = document.getElementById('file-to-upload').value;
		if (fullPath) {
			var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
			var filename = fullPath.substring(startIndex);
			if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
				filename = filename.substring(1);
			}
		document.getElementById('photo-text').textContent = filename;
		}
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







