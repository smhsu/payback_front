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
				<a class='navbar-brand' href='#'>Payback</a>
			</div>

			<div class='collapse navbar-collapse' id='nav-collapse'>
				<ul class='nav navbar-nav navbar-right'>
					<?php
						if (isset($_SESSION['user_id'])) {
							echo "<li><a href='logout_process.php' class='active'>Log out</a></li>";
						}
						else {
							echo "<li><a href='login.php' class='active'>Log in</a></li>";
							echo "<li><a href='register.html' class='active'>Register</a></li>";
						}
					?>
					<li><a href='#' class='active'>Home</a></li>
					<li><a href='#'>About</a></li>
				</ul>
			</div>

		</div> <!--End container-fluid-->
	</nav>

	<div id="add-friend-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
						<a class="close" data-dismiss="modal">×</a>
						<h3>Add friend (enter email):</h3>
				</div>
				<div class="modal-body">
						<form>
								<input type="text" class="input-xlarge" name="email" id="friend_email"><br>
						</form>
				</div>
				<div class="modal-footer">
						<input class="btn btn-success" type="submit" value="Add!" data-dismiss="modal" id="add_friend_btn">
						<a href="#" class="btn" data-dismiss="modal">Cancel</a>
				</div>
			</div>
		</div>
	</div>

	<div id="add-expense-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
						<a class="close" data-dismiss="modal">×</a>
						<h3>Add expense</h3>
				</div>
				<div class="modal-body">
						<form>
								<input type="text" class="input-xlarge"><br>
						</form>
				</div>
				<div class="modal-footer">
						<input class="btn btn-success" type="submit" value="Add!" data-dismiss="modal">
						<a href="#" class="btn" data-dismiss="modal">Cancel</a>
				</div>
			</div>
		</div>
	</div>

	<div class='container'>
		View expenses for...
		<select>
			<option value='friend1'>Friend 1</option>
			<option value='friend2'>Friend 2</option>
		</select>

		<a data-toggle="modal" href="#add-friend-modal" class="btn btn-primary">Add friend</a>
		<a data-toggle="modal" href="#add-expense-modal" class="btn btn-primary">Add new transaction</a>

		<div class='table-responsive'>
			<table class='table table-hover'>
				<thead>
					<th>Expense</th>
					<th>Amount owed</th>
					<th>Amount paid</th>
				</thead>
				<tr>
					<th>Cats</th>
					<th>Meow</th>
					<th>0</th>
				</tr>
				<tr>
					<th>More cats</th>
					<th>Meeeeow</th>
					<th>Only one meow</th>
				</tr>
			</table>
		</div>
	</div> <!--End container-->
	
	<script>
		// Get token from session data
		<?php
			if (isset($_SESSION['user_id'])) {
				echo "var token = \"" . $_SESSION['token'] . "\";";
				echo "getFriends()";
			}
			
		?>
		
		// ADD FRIEND
		document.getElementById("add_friend_btn").addEventListener("click", addFriendAjax, false);
		function addFriendAjax() {
            var friendEmail = document.getElementById("friend_email").value; // Get friend's email from form
			var dataString = "friend_email=" + encodeURIComponent(friendEmail) + "&token=" + encodeURIComponent(token);
        
            var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
            xmlHttp.open("POST", "add_friend.php", true); // Starting a POST request
            xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlHttp.addEventListener("load", function(event){
                var jsonData = JSON.parse(event.target.responseText); // Parse the JSON into a JavaScript object
                if (jsonData.success) {
					alert("Friend added!");
					getFriends();
                } else {
                    alert("Friend not added. " + jsonData.message);
                }
				this.removeEventListener("load", this);
            }, false); // Bind the callback to the load event
            xmlHttp.send(dataString); // Send the data
        }
		
		// GET FRIENDS (populates dropdown)
		function getFriends() {
			var dataString = "token=" + encodeURIComponent(token);
            var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
            xmlHttp.open("POST", "get_friends.php", true); // Starting a POST request
            xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlHttp.addEventListener("load", function(event){
                var jsonData = JSON.parse(event.target.responseText); // Parse the JSON into a JavaScript object
                if (jsonData.success) {
					// FIXME Populate friend dropdown with reponses
					for (i = 0; i < jsonData.count; i++) {
						console.log("Friend: " + jsonData[i].friend_username);
					}
					
                } else {
                    alert("Error: " + jsonData.message);
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
