<?php
// content="text/plain; charset=utf-8"

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pbac";
    $suaraPasanganSatu;
    $suaraPasanganDua;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connection failed: '.$conn->connect_error);
    }
    else {
        $query = 'select sum(islogged) as Sum from auth;';
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $isLogged = $row['Sum'];
        // Check jika semua calon telah login

        if ($isLogged == '4') {
            $query = 'select count(options) AS calon1 from qrcodesuratsuara where options=1';
            $result = $conn->query($query);
            $arrayCalonSatu = array('calon1'=>$result->fetch_assoc()['calon1']);

            //$suaraPasanganSatu = $row['Count'];

            $query = 'select count(options) AS calon2 from qrcodesuratsuara where options=2';
            $result = $conn->query($query);
            $arrayCalonDua = array('calon2'=>$result->fetch_assoc()['calon2']);
            //$suaraPasanganDua = $row['Count'];

            $query = 'select account.lokasi as lokasi,sum(case when options = 1 then 1 else 0 end) as countcalon1, sum(case when `options`=2 then 1 else 0 end) as countcalon2 from qrcodesuratsuara right join account on account.userID = qrcodesuratsuara.accountID group by lokasi';
            $result = $conn->query($query);
            $arrayLokasiCount = array();
            while($row = $result->fetch_assoc()){
                $arrayLokasi = array($row['lokasi']=>array($row['countcalon1'],$row['countcalon2']));
                array_push($arrayLokasiCount,$arrayLokasi);
            }

            $arrayChart = array('lokasicount'=>$arrayLokasiCount);

            echo json_encode(array_merge($arrayCalonSatu,$arrayCalonDua,$arrayChart));

        } else {
            echo "lock";
        }
    }


?>
