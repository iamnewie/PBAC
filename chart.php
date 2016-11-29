<?php // content="text/plain; charset=utf-8"

	require_once ('jpgraph/jpgraph.php');
	require_once ('jpgraph/jpgraph_pie.php');

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pbac";

	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$query = "select count(option) AS a from QRCodeSuratSuara where option=1";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$suaraPasanganSatu = $row['a'];

	
	$query = "select count(option) AS a from QRCodeSuratSuara where option=2";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$suaraPasanganDua = $row['a'];

	/*
	echo "
	<HTML>
		<HEAD>
			<TITLE>Quick Count Pilgub Banten 2017</TITLE>
		</HEAD>";
	*/
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
	/*
	echo "</HTML>";
	*/
?>
