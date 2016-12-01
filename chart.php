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
        .piechart {
            width: 30%;
            margin: 0 auto;
        }
    </style>

</head>

<body>
    <div class="w3-container w3-white">

    </div>
    <div class="w3-card-4 piechart  w3-animate-opacity w3-animate-top">
        <div class="w3-container w3-blue ">
            <h1>Total count</h1>
        </div>

        <div class="w3-container">
            <div id="chart_div" class="w3-center"></div>
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
                var options = {
                    width: "100%",
                    height: 400,
                    colors: ['#00F', '#F00']
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
                                        var image = document.createElement("img");
                                        image.setAttribute("src", "padlock.png");
                                        document.getElementById("chart_div").appendChild(image);
                                        isLocked = true;
                                    }
                                } else {
                                    //Membuat pie chartnya
                                    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                                    var split = results.split(';');
                                    var data = google.visualization.arrayToDataTable([
                                        ["Nama Calon", "Count"],
                                        ["Calon 1", parseInt(split[0])],
                                        ["Calon 2", parseInt(split[1])]
                                    ], false);
                                    chart.draw(data, options);
                                }

                            }

                        });
                    },
                    1000);
            }
        </script>
</body>

</html>
