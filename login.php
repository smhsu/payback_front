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
		<label>Password: </label><input type="password" name="password" id="password"/>
		<input type="submit" value="Log in" id="login_btn"/>
	</div>

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
	
	<?php
		include('import-scripts.php');
	?>

</body>
</html>
