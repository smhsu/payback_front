<?php
	session_start();
?>

<!DOCTYPE html>
<html lang='en'>
<?php
	readfile('head.html');
?>
<body>
	<?php
		include('navbar.php');
	?>

	<div class='container'>
		<label>Username: </label><input type="text" name="username" id="username"/><br>
		<label>Email: </label><input type="text" name="email" id="email"/><br>
		<label>Password: </label><input type="password" name="password" id="password"/>
		<input type="submit" value="Register" id="register_btn"/>
	</div>

	<script>
		document.getElementById("register_btn").addEventListener("click", registerAjax, false);
		function registerAjax(event) {
            var username = document.getElementById("username").value; // Get the username from the form
			var email = document.getElementById("email").value; // Get the email from the form
            var password = document.getElementById("password").value; // Get the password from the form

            var dataString = "username=" + encodeURIComponent(username) + "&email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password);

            var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
            xmlHttp.open("POST", "register_process.php", true); // Starting a POST request
            xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlHttp.addEventListener("load", function(event){
                var jsonData = JSON.parse(event.target.responseText); // Parse the JSON into a JavaScript object
                if (jsonData.success) {
					alert("You've been registered!");
					window.location = "http://ec2-52-37-155-208.us-west-2.compute.amazonaws.com/~payback/index.php";

                } else {
                    alert("You were not registered.  " + jsonData.message);
                }
				this.removeEventListener("load", this);
            }, false); // Bind the callback to the load event
            xmlHttp.send(dataString); // Send the data
        }
	</script>

	<?php
		include('import-scripts.php');
	?>

</body>
</html>
