<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src='js/bootstrap.min.js'></script>
<script src='js/network.js'></script>
<script src='js/modifyDom.js'></script>
<script>
	var token;
	// Get token from session data
	<?php
		if (isset($_SESSION['user_id'])) {
			echo "token = \"" . $_SESSION['token'] . "\";";
		}
	?>
</script>
