<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>
	// Get token from session data
	var token;
	var user_id;
	var username;
	<?php
		if (isset($_SESSION['user_id'])) {
			echo "token = \"" . $_SESSION['token'] . "\";";
			echo "user_id = \"" . $_SESSION['user_id'] . "\";";
			echo "username = \"" . $_SESSION['username'] . "\";";
		}
	?>
</script>
<script src='js/bootstrap.min.js'></script>
<script src="js/modifyDom.js"></script>
<script src='js/network.js'></script>
<script>
<?php
	if (isset($_SESSION['user_id'])) {
		echo "getFriends();";
	}
?>
</script>
