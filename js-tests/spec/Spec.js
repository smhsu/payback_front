describe("Modifiy table", function() {
	it ("Should be able to correctly populate the expense table for friend 2", function() {
		var tbody = constructExpenseTableBody(2)[1];
		expect(tbody.children().length).toBe(4);
		expect(tbody.find('.success').text()).toEqual("They owe $15");
		expect(tbody.find('.danger').text()).toEqual("You owe $200");
	});

	it ("Should be able to correctly populate the expense table for friend 3", function() {
		var tbody = constructExpenseTableBody(3)[1];
		expect(tbody.children().length).toBe(2);
		expect(tbody.find('.success').text()).toEqual("They owe $15");
	});
});
