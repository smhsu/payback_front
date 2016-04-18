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
			alert("Friend successfully added!");
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
			for (i = 0; i < jsonData.count; i++) {
				var username = jsonData[i].friend_username;
				var id = jsonData[i].friend_id;

				friendToId[username] = Number(id);
				var opt = new Option(username, id);
				$(opt).html(username);
				$("#friendsList").append(opt);
			}
		} else {
			alert("Error: " + jsonData.message);
		}
		this.removeEventListener("load", this);
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}

function getExpenses() {
	var dataString = "token=" + encodeURIComponent(token) + "&user_id=" + user_id;
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "get_expenses.php", true); // Starting a POST request
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xmlHttp.addEventListener("load", function(event){
		var jsonData = JSON.parse(event.target.responseText); // Parse the JSON into a JavaScript object
		if (jsonData.success) {
			expenses = jsonData.expenses;
			friendIdToExpenses = jsonData.friends;
			friendSelectChanged(); // FIXME find a better place for this
		} else {
			alert("Error: " + jsonData.message);
		}
		this.removeEventListener("load", this);
	}, false); // Bind the callback to the load event
	xmlHttp.send(dataString); // Send the data
}

function clone(obj) {
    if (null == obj || "object" != typeof obj) return obj;
    var copy = obj.constructor();
    for (var attr in obj) {
        if (obj.hasOwnProperty(attr)) copy[attr] = clone(obj[attr]);
    }
    return copy;
}

//$("#datepicker").datepicker();
//$(function() {
    var friendsAndUserToID = clone(friendToId);
		friendsAndUserToID[username] = user_id;

		var usernames = Object.keys(friendsAndUserToID);
		var availableUsernamesOwers = usernames;
		var availableUsernamesBuyers = usernames;
		var selectedOwers = [];
		var selectedBuyers = [];

		var dialog = $("#add-friend-modal");

    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }

<!-- GET READY FOR A LOT OF CODE DUPLICATION: will change later -->

      // don't navigate away from the field on tab when selecting an item
    $( '#new_owers' ).bind( "keydown", function( event ) {
      	if ( event.keyCode === $.ui.keyCode.TAB &&
        	$( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      });
    $( '#new_owers' ).autocomplete({
        minLength: 0,
				appendTo: "#add-expense-modal-body",
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response(
						$.ui.autocomplete.filter(
            usernames, extractLast( request.term )
					 )

					);
						$(".ui-autocomplete").attr("z-index", "2000");
        },
				focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
					console.log(this.value);
          // add the selected item
          terms.push( ui.item.value );
					console.log(ui.item.value);
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
			$( '#new_owers' ).attr('autocomplete', 'on');

			$( '#new_buyer_name' ).bind( "keydown", function( event ) {
	      	if ( event.keyCode === $.ui.keyCode.TAB &&
	        	$( this ).autocomplete( "instance" ).menu.active ) {
	          event.preventDefault();
	        }
	      });
	    $( '#new_buyer_name' ).autocomplete({
	        minLength: 0,
					appendTo: "#add-expense-modal-body",
	        source: function( request, response ) {
	          // delegate back to autocomplete, but extract the last term
	          response(
							$.ui.autocomplete.filter(
	            usernames, extractLast( request.term )
						 )

						);
							$(".ui-autocomplete").attr("z-index", "2000");
	        },
					focus: function() {
	          // prevent value inserted on focus
	          return false;
	        },
	        select: function( event, ui ) {
	          var terms = split( this.value );
	          // remove the current input
	          terms.pop();
						console.log(this.value);
	          // add the selected item
	          terms.push( ui.item.value );
						console.log(ui.item.value);
	          // add placeholder to get the comma-and-space at the end
	          terms.push( "" );
	          this.value = terms.join( ", " );
	          return false;
	        }
	      });
				$( '#new_buyer_name' ).attr('autocomplete', 'on');
//});
$(function(){
    $("#add_btn").click(function(){
        alert('clicked!');
				var session_id = '<?php echo session_id();?>';
				console.log(document.getElementById('session_id').value);
				var expenseName = document.getElementById('new_expense_name').value;
				console.log(document.getElementById('new_expense_name').value);
				var buyer = document.getElementById('new_buyer_name').value;
				console.log(document.getElementById('new_buyer_name').value);
				var totalAmount = document.getElementById('new_total_amount').value;
				console.log(document.getElementById('new_total_amount').value);
				var date = document.getElementById('datepicker').value;
				console.log(document.getElementById('datepicker').value);
				var buyers = document.getElementById('new_buyer_name').value;

				var owers = document.getElementById('new_owers').value;
				var arrOwers = owers.split(" ");
				var owersArray;
				var arrOwersLength = arrOwers.length;
				for(var i = 0; i < arrOwersLength; i++){
					owersArray.push({ ower_id: friendToId[friend], owed: 0.0, paid: 0.0 });
				}

				var addExpenseData = {
					token: session_id,
					expense_name: expenseName,
					buyer_id: friendToId[buyer],
					total_amount: totalAmount,
					date_added: date,
					owers: owersArray
				};

				$.ajax({
					type: "POST",
					url: "add_expense.php",
					data: addExpenseData,
					success: function(msg){
						console.log("json sent!");
			 			 }
					 });
    });
});
