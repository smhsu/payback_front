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

	<!--JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

	<!-- JQuery UI -->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

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
				<div class="modal-body" class="ui-widget" class="ui-front" id="add-expense-modal-body">
						<form>
								<label for="new_expense_name">Expense: </label>
								<input type="text" class="input-xlarge" id="new_expense_name" name="expense_name"><br>
								<label for="new_buyer_name">Buyer: </label>
								<input id="new_buyer_name" name="buyer_name" size="50"/></br>
								<label for="new_total_amount">Amount: </label>
								<input type="number" id="new_total_amount" name="total_amount"/></br>
								<label for="datepicker">Date: </label>
								<input type="text" id="datepicker"/></br>
								<label for="new_owers">Owers: </label>
								<input id="new_owers" name="ower_names" size="50"/></br>
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

		<a data-toggle="modal" href="#add-friend-modal" class="btn btn-primary" id="add-friend-modal">Add friend</a>
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


	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script>
		// Get token from session data
		var token;
		var user_id;
		var username;
		<?php
			if (isset($_SESSION['user_id'])) {
				echo "token = \"" . $_SESSION['token'] . "\";";
				echo "user_id = \"" . $_SESSION['user_id'] . "\";";
				echo "username = \"" . $_SESSION['username'] . "\";";
			}
		?>
	</script>
	<script src='js/bootstrap.min.js'></script>
	<script src="js/modifyDom.js"></script>
	<script src='js/network.js'></script>
	<script>
	<?php
		if (isset($_SESSION['user_id'])) {
			echo "getFriends();";
		}
	?>
	</script>

</body>
</html>
