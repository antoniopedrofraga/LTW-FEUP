

document.getElementById('signup').onclick = function() {

   var firstName = document.getElementById('firstName');
   var lastName = document.getElementById('lastName');
   var email = document.getElementById('email');
   var password = document.getElementById('password');
   var repeatPassword = document.getElementById('repeatPassword');

   var elements = [firstName, lastName, email, password, repeatPassword];

   for (index in elements) {

   		if(elements[index].value == '') {
   			onError(elements[index]);
   			return;
   		} else {
   			onOk(elements[index]);
   		}
   		
   }

   if(password.value != repeatPassword.value) {
   		swal("Oops...", "Your new passwords doesn't match!", "error");
   }

};


function onError(element) {
	element.style.borderColor = 'red';
	element.style.backgroundColor = '#FFDEDE';
}

function onOk(element) {
	element.style.borderColor = '#E2E2E2';
	element.style.backgroundColor = 'white';
}



