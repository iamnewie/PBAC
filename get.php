<?php
$username = 'root';
$password = '';
$dbname = 'pbac';
$host = 'localhost';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$queryString = "SELECT * FROM qrcodesuratsuara";
$res = $conn->query($queryString);

foreach($res as $data){
  echo $data[0]."<br>";
}

?>
