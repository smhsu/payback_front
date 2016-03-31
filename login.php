<?php
	session_start();
?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<title>Payback</title>

	<!-- Bootstrap -->
	<link href='css/bootstrap.min.css' rel='stylesheet'>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
		<script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
	<![endif]-->
</head>

<body>
	<nav class='navbar navbar-default' role='navigation' id='nav'>
		<div class='container-fluid' id='outer'>

			<div class='navbar-header' id='navlogo'>
				<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#nav-collapse'>
					<span class='sr-only'>Toggle navigation</span>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
				</button>
				<a class='navbar-brand' href='#'>Log in to Payback</a>
			</div>

			<div class='collapse navbar-collapse' id='nav-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					<li><a href='register.html' class='active'>Register</a></li>
					<li><a href='index.php' class='active'>Home</a></li>
					<li><a href='#'>About</a></li>
				</ul>
			</div>

		</div> <!--End container-fluid-->
	</nav>

	<label>Username: </label><input type="text" name="username" id="username"/><br>
	<label>Password: </label><input type="password" name="password" id="password"/>
	<input type="submit" value="Log in" id="login_btn"/>
	
	<script>
		document.getElementById("login_btn").addEventListener("click", loginAjax, false);
		
		function loginAjax(event) {
            var username = document.getElementById("username").value; // Get the username from the form
            var password = document.getElementById("password").value; // Get the password from the form
         
            var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);
         
            var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
            xmlHttp.open("POST", "login_process.php", true); // Starting a POST request
            xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlHttp.addEventListener("load", function(event){
                var jsonData = JSON.parse(event.target.responseText); // Parse the JSON into a JavaScript object
                if (jsonData.success) {
					window.location = "http://ec2-52-37-155-208.us-west-2.compute.amazonaws.com/~payback/index.php";
                    //alert("You've been logged in!");
					
                } else {
                    alert("You were not logged in.  " + jsonData.message);
                }
				this.removeEventListener("load", this);
            }, false); // Bind the callback to the load event
            xmlHttp.send(dataString); // Send the data
        }
	</script>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src='js/bootstrap.min.js'></script>
</body>
</html>
