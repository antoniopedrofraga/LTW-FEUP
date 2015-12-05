document.getElementById('updEvent').onclick = function() {
	
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

	var file_data = $('#file-to-upload')[0].files[0];

	console.log(file_data);

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
			if(data == 'true') {
				fd.append("replaced", "false");
				addEvent(fd);
			} else if (data == "repeated"){
				fd.append("replaced", "true");
				addEvent(fd);
			} else {
				swal("Oops...", data, "error");
			}
		}
	});

	return false;
}



function updEvent(fd) {
	$.ajax({
		url: '../actions/updEvent.php',
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
}

