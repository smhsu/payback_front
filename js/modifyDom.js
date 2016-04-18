function friendSelectChanged() {
	var friendId = $('#friendsList').val();
	var newTbody = constructExpenseTableBody(friendId);
	$('#expenses-table tbody').remove();
	$('#expenses-table').append(newTbody);
}

function constructExpenseTableBody(friendId) {
	var newTbody = $('<tbody></tbody>');

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

		var newRow = $('<tr></tr>');
		newRow.append($('<td>' + expense.expense_name + '</td>'));
		if (userOwes) {
			newRow.append($('<td class="danger">You owe $' + amountOwed + '</td>'));
		} else {
			newRow.append($('<td class="success">They owe $' + amountOwed + '</td>'));
		}
		newRow.append($('<td>$' + amountPaid + '</td>'));
		newTbody.append(newRow);
	}

	return newTbody;
}
