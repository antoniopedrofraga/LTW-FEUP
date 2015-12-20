

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

   if(!validateEmail(email.value)) {
      swal("Oops...", "Please insert a valid e-mail..." , "error");
      return false;
   }

   var teste = checkPassStrength(password.value);

   if(checkPassStrength(password.value) == "") {
      swal("Oops...", "Please insert a stronger password...", "error");
      return;
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
         swal("Oops...", "Error adding a user to the database..\n" + data, "error");
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


function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return String(email).search (re) != -1;
}


function checkPassStrength(pass) {
    var score = scorePassword(pass);
    if (score > 60)
        return "strong";
    if (score > 30)
        return "good";
    if (score >= 15)
        return "weak";

    return "";
}



function scorePassword(pass) {
    var score = 0;
    if (!pass)
        return score;

    // award every unique letter until 5 repetitions
    var letters = new Object();
    for (var i=0; i<pass.length; i++) {
        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
        score += 5.0 / letters[pass[i]];
    }

    // bonus points for mixing it up
    var variations = {
        digits: /\d/.test(pass),
        lower: /[a-z]/.test(pass),
        upper: /[A-Z]/.test(pass),
        nonWords: /\W/.test(pass),
    }

    variationCount = 0;
    for (var check in variations) {
        variationCount += (variations[check] == true) ? 1 : 0;
    }
    score += (variationCount - 1) * 10;

    return parseInt(score);
}


$('#password').keyup(function() {
   var password = $(this).val();
   var strength = checkPassStrength(password);

   if(password == "") {
      onOk(document.getElementById("password"));
   } else if (strength == "") {
      $(this).css({
      'border' : '2px solid red'
       });
   } else if (strength == "weak") {
      $(this).css({
      'border' : '2px solid #FF3300'
       });
   } else if (strength == "good") {
      $(this).css({
      'border' : '2px solid yellow'
       });
   } else if (strength == "strong") {
      $(this).css({
      'border' : '2px solid green'
       });
   }
});


$('#repeatPassword').keyup(function() {
   var password = $(this).val();
   var strength = checkPassStrength(password);


   if(password == "") {
      onOk(document.getElementById("repeatPassword"));
   } else if (strength == "") {
      $(this).css({
      'border' : '2px solid red'
       });
   } else if (strength == "weak") {
      $(this).css({
      'border' : '2px solid #FF3300'
       });
   } else if (strength == "good") {
      $(this).css({
      'border' : '2px solid yellow'
       });
   } else if (strength == "strong") {
      $(this).css({
      'border' : '2px solid green'
       });
   }
});