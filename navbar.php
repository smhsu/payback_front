<nav class='navbar navbar-default' role='navigation' id='nav'>
	<div class='container-fluid' id='outer'>

		<div class='navbar-header' id='navlogo'>
			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#nav-collapse'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			</button>
			<a class='navbar-brand' href='#'>Payback</a>
		</div>

		<div class='collapse navbar-collapse' id='nav-collapse'>
			<ul class='nav navbar-nav navbar-right'>
				<?php
					if (isset($_SESSION['user_id'])) {
						echo "<li><a href='logout_process.php'>Log out</a></li>";
					}
					else {
						echo "<li><a href='login.php'>Log in</a></li>";
						echo "<li><a href='register.php'>Register</a></li>";
					}
				?>
				<li><a href='#'>About</a></li>
			</ul>
		</div>

	</div> <!--End container-fluid-->
</nav>
