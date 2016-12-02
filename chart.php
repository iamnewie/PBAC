<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <!--<?php
        session_start();
        if (!isset($_SESSION['userId'])) {
            echo "<script type=\"text/javascript\">location.href='login.php'</script>";
        }
    ?>-->

    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

    <style>
            .header {
            margin: 10px auto;
            width: 500px;
            height: 200px;
        }

        .footer {
            margin-bottom: 0;
            width: 100%;
            height: 200px;
        }

        .foot_text {
            margin-left: 50px;
            margin-top: 20px;
        }

        .foot_text p {
            font-size: 11px;
        }

        .piechart {
            width: 500px;
            height: auto;
            margin: 100px auto;
        }

        .barchart {
            width: 900px;
            height: 500px;
            margin: 100px auto;
        }

        #padlock,
        #padlock2 {
            position: absolute;
            width: auto;
            height: auto;
            margin: auto;
            top: 10%;
            left: 0;
            bottom: 0;
            right: 0;
            display: none;
        }

        #loader,
        #loader2 {
            display: block;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            margin: auto;
            position: absolute;
            top: 10%;
            left: 0;
            bottom: 0;
            right: 0;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
    </style>

</head>

<body>
    <div class="w3-container header">
        <h1>Logo</h1>
    </div>

    <div class="w3-card-4 piechart  w3-animate-opacity w3-animate-top">
        <div class="w3-container w3-red ">
            <h1>Total suara</h1>
        </div>

        <div class="w3-container" style="width: 100%; height : 400px;">
            <div id="loader"></div>
            <img src="padlock_pic.png" id="padlock"></img>
            <div id="chart_div"></div>
        </div>
    </div>

    <div class="w3-card-4 barchart w3-animate-opacity w3-animate-top">
        <div class="w3-container w3-red">
            <h1> Total suara per daerah</h1>
        </div>

        <div class="w3-container" style="width: 100%; height : 400px;">
            <div id="loader2"></div>
            <img src="padlock_pic.png" id="padlock2"></img>
            <div id="chart2_div"></div>
        </div>
    </div>

    <div class="w3-container footer w3-red">
        <div class="foot_text">
            <h3>Created by :</h3>
            <p>
                Nelson Wijaya <br> Matthew Edward <br> Devin Ryan Riota <br> Dhanny Kurniawan <br> Wahyudi Khusnandar
            </p>
        </div>


    </div>


    <!-- scripts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });


        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            var chart2 = new google.visualization.BarChart(document.getElementById('chart2_div'));

            google.visualization.events.addListener(chart, 'ready', function() {
                document.getElementById("loader").style.display = "none";
            });

            google.visualization.events.addListener(chart, 'ready', function() {
                document.getElementById("loader").style.display = "none";
            });

            var options = {
                width: "100%",
                height: 400,
                colors: ['#2196F3', '#F44336']
            };

            var options2 = {
                width: "100%",
                height: 400,
                colors: ['#2196F3', '#F44336']
            };

            var isLocked = false;

            //Mengecheck database secara terus menerus
            setInterval(function() {
                    $.ajax({
                        url: "getQuickCount.php",
                        type: "POST",
                        async: true,
                        success: function(results) {
                            if (results == "lock") {
                                if (isLocked == false) {
                                    //Tampil image padlock jika tidak semua calon login
                                    document.getElementById("loader").style.display = "none";
                                    document.getElementById("loader2").style.display = "none";

                                    document.getElementById("padlock").style.display = "block";
                                    document.getElementById("padlock2").style.display = "block";

                                    document.getElementById("chart_div").style.display = "none";
                                    document.getElementById("chart2_div").style.display = "none";
                                    isLocked = true;
                                }
                            } else {
                                //Membuat pie chartnya
                                document.getElementById("padlock").style.display = "none";
                                document.getElementById("chart_div").style.display = "block";

                                var split = results.split(';');
                                var data = google.visualization.arrayToDataTable([
                                    ["Nama Calon", "Count"],
                                    ["Calon 1", parseInt(split[0])],
                                    ["Calon 2", parseInt(split[1])]
                                ], false);
                                chart.draw(data, options);

                                //Membuat bar chart
                                document.getElementById("padlock2").style.display = "none";
                                document.getElementById("chart2_div").style.display = "block";
                                chart2.draw(data, options);


                            }

                        }

                    });
                },
                1000);
        }
    </script>
</body>

</html>
