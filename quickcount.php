<html>
  <head>
    <?php
      $servername = "";
      $username = "";
      $password = "";
      $dbname = "";
      $jumlahCalon = 4;
      try{
        $dbconn = mysqli_connect($servername,$username,$password,$dbname);
      }catch(Exception $e){
        echo $e;
        die();
      }

      $query = "SELECT count(*) as jumlahLogin from auth where isLogged = 1";
      $result = mysqli_query($dbconn,$query);
      if(mysqli_fetch_array($result)["jumlahLogin"] != jumlahCalon){
        echo "Gembok";
        while(true){
          $result = mysqli_query($dbconn,$query);
          if(mysqli_fetch_array($result)["jumlahLogin"] == jumlahCalon){
            break;
          }
        }
      }
  ?>
</head>
  <body>
  </body>
</html>
