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
				<div class="modal-body" class="ui-widget" class="ui-front" id="add-expense-modal-body">
						<form>
								<label for="new_expense_name">Expense: </label>
								<input type="text" class="input-xlarge" id="new_expense_name" name="expense_name"><br>
								<label for="new_buyer_name">Buyer: </label>
								<input id="new_buyer_name" name="buyer_name" size="50"/></br>
								<label for="new_total_amount">Amount: </label>
								<input type="number" id="new_total_amount" name="total_amount" min="0"/></br>
								<label for="datepicker">Date: </label>
								<input type="date" id="datepicker"/></br>
								<label for="new_owers">Owers: </label>
								<input id="new_owers" name="ower_names" size="50"/></br>
						</form>
				</div>
				<div class="modal-footer">
						<input class="btn btn-success" id="add_btn" type="submit" value="Add!" data-dismiss="modal">
						<a href="#" class="btn" data-dismiss="modal">Cancel</a>
				</div>
			</div>
		</div>
	</div>

	<div class='container'>
		View expenses for...
		<select id="friendsList" onchange="friendSelectChanged()">
		</select>

		<a data-toggle="modal" href="#add-friend-modal" class="btn btn-primary" id="add-friend-modal">Add friend</a>
		<a data-toggle="modal" href="#add-expense-modal" class="btn btn-primary">Add new transaction</a>

		<div class='table-responsive'>
			<table class='table table-hover' id='expenses-table'>
				<thead>
					<tr>
						<th>Expense</th>
						<th>Amount owed</th>
						<th>Amount paid</th>
					</tr>
				</thead>
			</table>
		</div>
	</div> <!--End container-->

	<?php
		include('import-scripts.php');
	?>

</body>
</html>
