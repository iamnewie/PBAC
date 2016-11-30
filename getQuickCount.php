<?php
// content="text/plain; charset=utf-8"

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'pbac';
    $namaCalonSatu="Nelson";
    $namaCalonDua="Matthew";
    $countCalonSatu=0;
    $countCalonDua=0;

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connection failed: '.$conn->connect_error);
    }

    $query = 'select sum(islogged) as Sum from auth;';
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $isLogged = $row['Sum'];
    if ($isLogged == '4') {
        $query = 'select count(options) AS Count from QRCodeSuratSuara where options=1';
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $suaraPasanganSatu = $row['Count'];

        $query = 'select count(options) AS Count from QRCodeSuratSuara where options=2';
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $suaraPasanganDua = $row['Count'];

        $arr = array(
            'cols' => array("id" => "A", "label" => "calon","pattern" => "", "type"=>"string"),
                    array("id" => "B", "label" => "count","pattern" => "", "type"=>"number"),
            'rows' => array(
                "c" => array("v" => "$namaCalonSatu", "v" => "$countCalonSatu"),
                "c"=> array("v" => "$namaCalonDua", "v" => "$countCalonDua")
            ));
    }

    echo json_encode($arr);
