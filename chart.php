<?php // content="text/plain; charset=utf-8"

	require_once ('jpgraph/jpgraph.php');
	require_once ('jpgraph/jpgraph_pie.php');

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pbac";

	if(!isset($_SESSION['userId'])){
   echo "<script type=\"text/javascript\">location.href='login.php'</script>";
}

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$query = "select sum(islogged) as A from auth;";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$isLogged = $row['A'];
	if($isLogged=="4")
	{
		$query = "select count(options) AS a from QRCodeSuratSuara where options=1";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		$suaraPasanganSatu = $row['a'];


		$query = "select count(options) AS a from QRCodeSuratSuara where options=2";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		$suaraPasanganDua = $row['a'];

		// Some data
		$data = array($suaraPasanganSatu,$suaraPasanganDua);

		// Create the Pie Graph.
		$graph = new PieGraph(700,500);

		$theme_class="DefaultTheme";
		//$graph->SetTheme(new $theme_class());

		// Set A title for the plot
		$graph->title->Set("A Simple Pie Plot");
		$graph->SetBox(true);

		// Create
		$p1 = new PiePlot($data);
		$graph->Add($p1);

		$p1->ShowBorder();
		$p1->SetColor('black');
		$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F','#DC143C','#BA55D3'));
		$graph->Stroke();
	}
	else
		echo "	<HTML>
					<BODY align='center'>
						<IMG src='padlock.png' height='480'></img>
					</BODY>
				</HTML>";
?>
