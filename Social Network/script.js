

document.getElementById('sinbtn').onclick = function() {

   var email = document.getElementById('signinEmail');
   var password = document.getElementById('signinPassword');

   var elements = [email, password];

   for (index in elements) {

      if(elements[index].value == '') {
         onError(elements[index]);
         return false;
      } else {
         onOk(elements[index]);
      }

   }

   var script = $.post("./actions/getUsers.php",  {email: email.value, password: password.value});

   script.done(function(data) {
      
      if(data == 'true') {
            var sin = document.getElementById('sin');
            sin.submit();
            return true;
      }

      swal("Oops...", "There is not a user registed with that e-mail and password...", "error");
   });

   script.fail(function() {
      swal("Oops...", "Error getting users from database..", "error");
   });

   return false;
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
   			return false;
   		} else {
   			onOk(elements[index]);
   		}

   }

   if(password.value != repeatPassword.value) {
   		swal("Oops...", "Your new passwords doesn't match!", "error");
         return false;
   }

   var script = $.post("./actions/getUsers.php", {email: email.value, password: password.value});

   script.done(function(data) {
      
      if(data == 'true') {
            swal("Oops...", "There is a user registed with that e-mail and password...", "error");
      } else {

         if (addUser(new User(firstName.value, lastName.value, email.value, password.value)) == true)
            return true;

      }

   });

   script.fail(function() {
      swal("Oops...", "Error getting users from database..", "error");
   });

   return false;

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

   var userPost = $.post("./actions/addUser.php", { firstName: user.firstName, lastName: user.lastName, email: user.email, password: user.password} );

   userPost.done(function(data) { 
      
      if(data != 'true') {
         swal("Oops...", "Error adding a user to the database..", "error");
      } else {
         var sup = document.getElementById('sup');
         sup.submit();
         return true;
      }

   });

   userPost.fail(function() {
      swal("Oops...", "Error adding a user to the database..", "error");
   });

   return false;

}


function User(firstName, lastName, email, password) {
   this.firstName = firstName;
   this.lastName = lastName;
   this.email = email;
   this.password = password;
}


