<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pbac";
$jumlahCalon = 4;

try{
  $dbconn = mysqli_connect($servername,$username,$password,$dbname);
}catch(Exception $e){
  echo $e;
  die();
}

$query = "SELECT count(*) as jumlahLogin from auth where isLogged = 1";
$result = mysqli_query($dbconn,$query);

if(mysqli_fetch_array($result)["jumlahLogin"] != $jumlahCalon){
  echo "Gembok";
  $thread = new AsyncOperation($query,$dbconn);
}
  mysqli_close($dbconn);

?>
