

$('#updatePic').on('click', function(event){
		$('.profilePic').click();
		return false;
});


$(".profilePic").change(function() {
	var fullPath = $(".profilePic").val();
	if (fullPath) {
		var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
		var filename = fullPath.substring(startIndex);
		if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
			filename = filename.substring(1);
		}

		var fd = new FormData();
		var file_data = $('.profilePic')[0].files[0];

		fd.append("fileToUpload", file_data);
		fd.append("email", $('#user').text());

		$.ajax({
			url: '../actions/uploadProfilePic.php',
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

	}
});