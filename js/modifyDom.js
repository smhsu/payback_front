function friendSelectChanged() {
	var friendId = $('#friendsList').val();
	var tuple = constructExpenseTableBody(friendId);
	var totalOwed = tuple[0];
	var newTbody = tuple[1];
	$('#expenses-table tbody').remove();
	$('#expenses-table').append(newTbody);

	var name = $('#friendsList option:selected').text();
	$('.total-owed-box').removeClass('alert-success alert-danger')
	if (totalOwed <= 0) {
		$('.total-owed-box').addClass('alert-success');
		$('.total-owed-box').text(name + " owes you $" + (-1*totalOwed));
	} else {
		$('.total-owed-box').addClass('alert-danger');
		$('.total-owed-box').text("You owe " + name + "$" + totalOwed);
	}

	$(".expand").click(function() {

			$(this).next().toggle();

	});
}

/*
 * Returns [balance, tableBody]
 * FIXME: separate these two returns into separate functions
 */
function constructExpenseTableBody(friendId) {
	var newTbody = $('<tbody></tbody>');
	var totalOwed = 0;

	var allInvolvedExpenseIds = friendIdToExpenses[friendId];
	for (i in allInvolvedExpenseIds) {
		var expenseId = allInvolvedExpenseIds[i];
		var expense = expenses[expenseId];

		var userOwes = false;
		var owerIdToSearch = '';
		var amountOwed = -1;
		var amountPaid = -1;
		if (expense.buyer_id == user_id) {
			owerIdToSearch = friendId;
			userOwes = false;
		} else if (expense.buyer_id == friendId) {
			owerIdToSearch = user_id;
			userOwes = true;
		} else {
			continue;
		}

		for (j in expense.owers) {
			var ower = expense.owers[j]
			if (ower.ower_id == owerIdToSearch) {
				amountOwed = ower.owed;
				amountPaid = ower.paid;
			}
		}
		if (userOwes) {
			totalOwed += amountOwed;
		} else {
			totalOwed -= amountOwed;
		}

		var newRow = $('<tr class="expand"></tr>');
		var detailRow = $('<tr></tr>');
		newRow.append($('<td>' + expense.expense_name + '</td>'));
		if (userOwes) {
			newRow.append($('<td class="danger">You owe $' + amountOwed + '</td>'));
		} else {
			newRow.append($('<td class="success">They owe $' + amountOwed + '</td>'));
		}
		newRow.append($('<td>$' + amountPaid + '</td>'));
		detailRow.append($('<td>Total: ' + expense.total_amount + '</td>'));
		detailRow.append($('<td>Date Added: ' + expense.date_added + '</td>'));
		newTbody.append(newRow);
		newTbody.append(detailRow);
	}

	return [totalOwed, newTbody];
}

$(".expand").click(function() {

		$(this).next().toggle();

});
