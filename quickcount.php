<html>
  <head>
    <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "pbac";
      $jumlahCalon = 4;

      class AsyncOperation extends Thread {
          public $query;
          public $dbconn;

          public function __construct($query,$dbconn) {
            $this->$query = $query;
            $this->$dbconn = $dbconn;
          }

          public function run() {
                  while(true){
                    $result = mysqli_query($dbconn,$query);
                    if(mysqli_fetch_array($result)["jumlahLogin"] == $jumlahCalon){
                      echo "Berhasil Login";
                      break;
                    }
                  }
          }
      }

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
        $thread = new AsyncOperation($query,$dbconn)start;
		$thread->start();
      }
        mysqli_close($dbconn);

  ?>
</head>
  <body>
  </body>
</html>