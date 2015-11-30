

var pdd = new DropDown( $('#privacy-dd') );
var tdd = new DropDown( $('#type-dd') );

$('.privacy-div').on('click', function(event){
		$('.dropdown-div').removeClass('active');
		$(this).toggleClass('active');
		return false;
});

	//...

$(function() {

		console.log(pdd);
		console.log(tdd);

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

	var sup = document.getElementById('submit-value');
	sup.submit({privacySpan: document.getElementById('privacy-span').textContent});
	return true;
}

$('#file-to-upload').bind('change', function() {

  if (this.files[0].size > 5 * 1048576) {

  		swal("Oops...", "You can not upload a file with more than 5 MB...", "error");
  		document.getElementById('file-to-upload').value = "";

  } else if (this.files[0].type != 'image/png' && this.files[0].type != 'image/jpeg' && this.files[0].type != 'image/gif' && this.files[0].type != 'image/jpg') {
  		
  		swal("Oops...", "You can only upload files with .GIF, .JPG, .JPEG, or .PNG extensions...", "error");
  		document.getElementById('file-to-upload').value = "";

  }

});


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



