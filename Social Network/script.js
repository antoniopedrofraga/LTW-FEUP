

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

   var script = $.getJSON("./getUsers.php");

	script.done(function(data) {
    	for(index in data) {
         if(data[index].email == email.value) {
            swal("Oops...", "There is a user registed with that e-mail..", "error");
            return;
         }
      }
      addUser(new User(firstName.value, lastName.value, email.value, password.value));
	});

};

function onError(element) {
	element.style.borderColor = 'red';
	element.style.backgroundColor = '#FFDEDE';
}

function onOk(element) {
	element.style.borderColor = '#E2E2E2';
	element.style.backgroundColor = 'white';
}


function addUser(user) {
    $.get('addUser.php', {user : $(this).val()}, function(data) {
        //swal("Good job!", "You are now registed!", "success");
        console.log(data);
    });
}


function User(firstName, lastName, email, password) {
   this.firstName = firstName;
   this.lastName = lastName;
   this.email = email;
   this.password = password;
}


