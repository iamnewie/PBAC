<html>

	<head>
			<?php
				if(isset($_POST["login"])) {
					$userId = $_POST["userId"];
					$password = $_POST["password"];

				}
			?>
		<!-- Basics -->

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Login</title>

		<!-- CSS -->

		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/styles.css">

		<h1>Login Quick Count</h1>

	</head>


	<body>
		<div id="container">
			<form method="post">
				<label for="name">Username:</label>
				<input type="name" name="userId"/>
				<label for="username">Password:</label>
				<p><a href="#">Forgot your password?</a>
				<input type="password" name="password"/>
				<div id="lower">
					<!--<input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label>-->
					<input type="submit" value="Login" name="login"/>
				</div>
			</form>
		</div>
	</body>
</html>
