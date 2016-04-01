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
