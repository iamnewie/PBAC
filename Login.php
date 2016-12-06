<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<?php
        if (isset($_POST['login'])) {
						$servername = "localhost";
						$username = "u549788653_pilka";
						$password = "pitacu#";
						$dbname = "u549788653_pbac";
            $conn = new mysqli($servername, $username, $password, $dbname);

            $userId = mysqli_real_escape_string($conn, $_POST['userId']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

          // Check connection
          if ($conn->connect_error) {
              die('Connection failed: '.$conn->connect_error);
          }
            $query = 'select 1 from auth where hour(now()) >= 10;';
            $result = $conn->query($query);
            if ($result->num_rows == 0) {
                echo "<SCRIPT>alert('please login after 14:00 WIB');</SCRIPT>";
            } else {
                $query = "select count(*) as result from auth where username = '".$userId."' and password = md5('".$_POST['password']."')";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            if ($row['result'] != 0) {
                $query = "update auth set isLogged=1 where username = '".$userId."'";
                if ($result = $conn->query($query)) {
                    echo "<SCRIPT>alert('you\'re logged in, Mr. ".$userId."');</SCRIPT>";
                }

                echo "<script type=\"text/javascript\">location.href = 'quickcount.html';</script>";
            } else {
                echo "<SCRIPT>alert('wrong password');</SCRIPT>";
            }
          }
            $conn->close();
        }
      ?>

		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

		<style>
		body{
			font-family: 'Montserrat',sans-serif;
		}
			.inputform {
				width: 30%;
				height: 350px;
				margin: 150 auto;
			}

			.button {
				position: absolute;
				bottom: 50px;
				right: 20px;
			}
		</style>

		<title>Pilkasmart Login</title>
</head>

<body>
	<div class="w3-row">
		<div class="w3-col s1 m3 l3" style="height : 100%;"></div>
		<div class="w3-card-4 inputform w3-animate-opacity w3-animate-top w3-col s10 m6 l6">
			<div class="w3-container w3-red">
				<h2><b>PILKASMART LOGIN</b></h2>
			</div>

			<form method="post" action="#">

				<p>
					<div class="w3-container">
						<label><b>Username :</b></label>
						<input class="w3-input" name="userId" type="text" required></input>
					</div>

					<p>
						<div class="w3-container">
							<label><b>Password :</b></label>
							<input class="w3-input w3- passwordInput" name="password" type="password" required></input>
						</div>

						<p>
							<div class="w3-container button">
								<button class="w3-btn w3-white w3-border w3-border-red w3-round-large w3-hover-blue" type="submit" value="Login" name="login">
								Login
							</button>

								<button type="button" class="w3-btn w3-white w3-border w3-border-red w3-round-large w3-hover-blue" onclick="window.location.href='quickcount.html'" name="back">Back</button>
							</div>

			</form>
		</div>
		<div class="w3-col s1 m3 l3" style="height:100%"></div>
	</div>
</body>
</html>
