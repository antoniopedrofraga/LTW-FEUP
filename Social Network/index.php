<?php 
session_start();
if(isset($_SESSION["email"])) {
    header('Location: ./pages/feed.php');
    die();
}
?>

<!doctype html>
<html>
	<head>

    <link href='https://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="./res/images/logo.png">
    <title>Wired In</title> <!-- Color: #172626 -->
 </head>


	<header>

		<div class="logo">
			<img src="./res/images/logo.png">
		</div>

		<h1><a href="./index.php">Wired In</a></h1>
		
    <form action="./pages/feed.php" method="post" id="sin">
          		Email&nbsp&nbsp<input type="text" name='email' class="signinTextBox" id='signinEmail'/>
          		&nbsp&nbspPassword&nbsp&nbsp<input type="password" name='password' class="signinTextBox" id='signinPassword'/>
          		<input type="submit" name="LogIn" value="Log In" id='sinbtn'>
    </form>

	</header>

	<body>

		
		<div style="width: 800px; height:400px; margin: 0px auto 0px auto;">
  			<table>
    			<tr>
      				<td width="50%" valign="top"class="lado">
      					<br> </br>
        				<h2>A LTW Social Network.</h2>
        				<br></br>
                <img src="./res/images/graduate.png" heigth="128px" width="128px">
                <br></br>
        			   <h3>Studying today, working tomorrow.</h3>
      				</td>
            

      				<td width="50%" valign="top" class="hey">
   						<br></br>
        				<h2>Join us!</h2>
	        				<form action="./pages/feed.php" method="post" id="sup">
          						<input type="text" class="signupTextBox" id="firstName" size="25" placeholder="First Name" class="sidebyside"/>
          						<input type="text" class="signupTextBox" id="lastName" size="25" placeholder="Last Name" class="sidebyside"/><br /><br />
          						<input type="text" class="signupTextBox" name="email" id="email" size="25" placeholder="E-mail" /> <br /><br />
         				  		<input type="password" class="signupTextBox" name="password" id="password" size="25" placeholder="Password" /> <br />
          						<input type="password" class="signupTextBox" id="repeatPassword" size="25" placeholder="Repeat your password" /><br /> <br />
     					 		    <input type="submit" name="SignUp" value="Sign Up" id="signup">
       						</form>
 				 	</td>
			 	</tr>
  			</table>
		</div>		
	</body>
  <footer>

    <div class="title" id="cont">
      <a>Info</a>
   </div>
  
    <div class="title" id="cont">
      <a href="./index.html"><img src="./res/images/home.png" height="50" width="50"></a>
      <a target="_blank" href="https://github.com/pedrofraga05/LTW-FEUP/tree/master/Social%20Network"><img src="./res/images/git.png" height="50" width="50"></a>
      <a href="./about.html"><img src="./res/images/info.png" height="50" width="50"></a>
    </div>

    <div class="buttons" id="cont">
      <a href="./index.php">HOME</a>
      <a>|</a>
      <a target="_blank" href="https://github.com/pedrofraga/LTW-FEUP/tree/master/Social%20Network">SOURCE</a>
      <a>|</a>
      <a href="./about.html">ABOUT</a>
    </div>

  </footer>

  <script type="text/javascript" src="script.js"></script>
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  
  <!--using sweet alert-->
  <script src="./sweetalert/dist/sweetalert.min.js"></script> <link rel="stylesheet" type="text/css" href="./sweetalert/dist/sweetalert.css">
</html>
