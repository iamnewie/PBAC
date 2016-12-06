<?PHP
	$servername = "localhost";
	$username = "u549788653_pilka";
	$password = "pitacu#";
	$dbname = "u549788653_pbac";


	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$query = "select sum(islogged) as A from auth;";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$isLogged = $row['A'];
	echo $isLogged;
	$conn->close();
?>
