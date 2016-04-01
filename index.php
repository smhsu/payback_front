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

	<?php
		include('import-scripts.php');
	?>

</body>
</html>
