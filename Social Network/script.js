

document.getElementById('sinbtn').onclick = function() {

   var email = document.getElementById('signinEmail');
   var password = document.getElementById('signinPassword');

   var script = $.getJSON("./getUsers.php");

   script.done(function(data) {
      for(index in data) {
         if(data[index].email == email.value && data[index].password == password.value) {
            swal("Done", "Loged in!", "success");
            return;
         }
      }
      swal("Oops...", "There is not a user registed with that e-mail and password...", "error");
   });

   script.fail(function() {
    swal("Oops...", "Error getting users from database..", "error");
   });

};




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

   script.fail(function() {
    swal("Oops...", "Error getting users from database..", "error");
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

   var userPost = $.post("./addUser.php", { firstName: user.firstName, lastName: user.lastName, email: user.email, password: user.password} );

   userPost.done(function(data) { 

      if (data == 'true') {
         swal("Done", "Thank you for sign up!", "success");
      }

   });

   userPost.fail(function() {
    swal("Oops...", "Error adding a user to the database..", "error");
   });

}


function User(firstName, lastName, email, password) {
   this.firstName = firstName;
   this.lastName = lastName;
   this.email = email;
   this.password = password;
}


