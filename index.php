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
						<h3>Add friend</h3>
				</div>
				<div class="modal-body">
						<form>
								<input type="text" class="input-xlarge" name="email" id="friend_email" placeholder="email"><br>
						</form>
				</div>
				<div class="modal-footer">
						<input class="btn btn-success" type="submit" value="Add!" data-dismiss="modal" id="add_friend_btn">
						<a href="#" class="btn" id="cancel_friendship" data-dismiss="modal">Cancel</a>
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
								<label for="new_expense_name">Expense name: </label>
								<input type="text" class="input-xlarge" id="new_expense_name" name="expense_name"><br>
								<label for="new_buyer_name">Buyer: </label>
								<input id="new_buyer_name" name="buyer_name" size="50" placeholder="Enter one name"/></br>
								<label for="new_total_amount">Amount: </label>
								<input type="number" id="new_total_amount" name="total_amount" min="0"/></br>
								<i>This amount will be split equally between all owers and you.</i><br>
								<label for="new_owers">Owers: </label>
								<input id="new_owers" name="ower_names" size="50" placeholder="Enter one or more names"/></br>
								<label for="datepicker">Date: </label>
								<input type="date" id="datepicker"/></br>

						</form>
				</div>
				<div class="modal-footer">
						<input class="btn btn-success" id="add_btn" type="submit" value="Add!" data-dismiss="modal">
						<a href="#" class="btn" id="cancel_expense" data-dismiss="modal">Cancel</a>
				</div>
			</div>
		</div>
	</div>

	<div id="add-transaction-modal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
						<a class="close" data-dismiss="modal">×</a>
						<h3>Pay off expenses</h3>
				</div>
				<div class="modal-body" class="ui-widget" class="ui-front" id="add-expense-modal-body">
						<form>
								<label for="amount_paid">Amount: </label>
								<input type="number" id="amount_paid" name="total_amount"/></br>
								<i>This amount will automatically go towards paying off the oldest expense.</i>

						</form>
				</div>
				<div class="modal-footer">
						<input class="btn btn-success" type="submit" value="Add!" data-dismiss="modal" id="add_transaction_btn">
						<a href="#" class="btn" id="cancel_transaction" data-dismiss="modal">Cancel</a>
				</div>
			</div>
		</div>
	</div>

	<div class='container'>
		View expenses for...
		<select id="friendsList" onchange="friendSelectChanged()">
		</select>

		<a data-toggle="modal" href="#add-friend-modal" class="btn btn-primary" id="add-friend-modal">Add friend</a>
		<a data-toggle="modal" href="#add-expense-modal" class="btn btn-primary">Split a new expense</a>
		<a data-toggle="modal" href="#add-transaction-modal" class="btn btn-primary">Pay off expenses</a>

		<p class="alert-danger total-owed-box">You owe this person a total of 5 cats.</p>

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
