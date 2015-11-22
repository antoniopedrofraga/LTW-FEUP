var products = ['ABCD', 'DEFG'];



document.getElementById('signup').onclick = function() {

   var firstName = document.getElementById('firstName').value;
	
	if (firstName == "") {
		swal({   title: "Are you sure?",   text: "You will not be able to recover this imaginary file!",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){   swal("Deleted!", "Your imaginary file has been deleted.", "success"); });
	} else {
		sweetAlert("Oops...", "You must write your name at the 'First Name' field in order to sign up!" + firstName, "error");
	}

};



