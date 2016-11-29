<html>

	<head>
			<?php
				if(isset($_POST["login"])) {
					$userId = $_POST["userId"];
					$password = $_POST["password"];
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "pbac";

					$conn = new mysqli($servername, $username, $password, $dbname);

					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					$query = "select 1 from auth where hour(now()) >= 10;";
					$result = $conn->query($query);
					if ($result->num_rows == 0)
					{
						echo "<SCRIPT>alert('please login after 14:00 WIB');</SCRIPT>";
					}else
					{
						$query="select count(*) as result from auth where username = '".$userId."' and password = md5('".$_POST["password"]."')";
						$result = $conn->query($query);
						$row = $result->fetch_assoc();
						if($row["result"]!= 0)
						{
							$query = "update auth set isLogged=1 where username = '".$userId."'";
							if($result = $conn->query($query))
								echo "<SCRIPT>alert('you\'re logged in, Mr. ".$userId."');</SCRIPT>";
						}
						else
						{
							echo "<SCRIPT>alert('wrong password');</SCRIPT>";
						}
					}
					$conn->close();
				}
			?>

			<script>
				
			</script>
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
			<form method="post" action="#">
				<label for="name">Username:</label>
				<input type="name" name="userId" required/>
				<label for="username">Password:</label>
				<p><a href="#">Forgot your password?</a>
				<input type="password" name="password" required/>
				<div id="lower">
					<!--<input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label>-->
					<input type="submit" value="Login" name="login"/>
				</div>
			</form>
		</div>
	</body>
</html>
