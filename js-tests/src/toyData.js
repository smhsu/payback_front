var user_id = 1; // User of the app

var expenses = {
	"1": {
		expense_id: 1,
		expense_name: "Food",
		buyer_id: 1,
		total_amount: 30.0,
		date_added: "4/8/16",
		owers:[
			{ ower_id: 2, owed: 15.0, paid: 0.0 },
			{ ower_id: 3, owed: 15.0, paid: 0.0 }
		]
	},
	"2": {
		expense_id: 2,
		expense_name: "Rent",
		buyer_id: 2,
		total_amount: 500.0,
		date_added: "4/8/16",
		owers:[
			{ ower_id: 3, owed: 200.0, paid: 0.0 },
			{ ower_id: 1, owed: 200.0, paid: 0.0 }
		]
	}
};

var friendIdToExpenses = {
	"1": [1, 2],
	"2": [1, 2],
	"3": [1, 2]
};
