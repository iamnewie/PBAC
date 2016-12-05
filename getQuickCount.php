<?php
// content="text/plain; charset=utf-8"

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'pbac';
    $suaraPasanganSatu;
    $suaraPasanganDua;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connection failed: '.$conn->connect_error);
    }

    $query = 'select sum(islogged) as Sum from auth;';
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $isLogged = $row['Sum'];
    // Check jika semua calon telah login

    if ($isLogged == '4') {
        $query = 'select count(options) AS calon1 from QRCodeSuratSuara where options=1';
        $result = $conn->query($query);
        $arrayCalonSatu = array('calon1'=>$result->fetch_assoc()['calon1']);

        //$suaraPasanganSatu = $row['Count'];

        $query = 'select count(options) AS calon2 from QRCodeSuratSuara where options=2';
        $result = $conn->query($query);
        $arrayCalonDua = array('calon2'=>$result->fetch_assoc()['calon2']);
        //$suaraPasanganDua = $row['Count'];

        $query = 'select account.lokasi as lokasi,count(accountid) as countlokasi from qrcodesuratsuara right join account on account.userID = qrcodesuratsuara.accountID group by lokasi';
        $result = $conn->query($query);
        $arrayLokasiCount = array();
        while($row = $result->fetch_assoc()){
            $arrayLokasi = array($row['lokasi']=>$row['countlokasi']);
            array_push($arrayLokasiCount,$arrayLokasi);
        }

        $arrayChart = array('lokasicount'=>$arrayLokasiCount);

        echo json_encode(array_merge($arrayCalonSatu,$arrayCalonDua,$arrayChart));

    } else {
        echo "lock";
    }
?>
