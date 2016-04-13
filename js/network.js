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
		var selectedUsersToID = [];

		var dialog = $("#add-friend-modal");

    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
      // don't navigate away from the field on tab when selecting an item
    $( "#new_owers" ).bind( "keydown", function( event ) {
      	if ( event.keyCode === $.ui.keyCode.TAB &&
        	$( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      });
    $( "#new_owers" ).autocomplete({
        minLength: 0,
				appendTo: "#add-expense-modal-body",
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            usernames, extractLast( request.term ) ) );
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
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
			$( "#new_owers" ).attr('autocomplete', 'on');

//});
