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


    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">

    <style>
        .demo-card-wide.mdl-card {
            width: 512px;
        }

        .demo-card-wide>.mdl-card__title {
            color: #000;
            height: 176px;
            background-color: #fff;
        }

        .demo-card-wide>.mdl-card__menu {
            color: #fff;
        }
    </style>

</head>

<body>

    <div class="demo-card-wide mdl-card mdl-shadow--2p">
        <div class="mdl-card__title">
            <h2 class="mdl-card__title-text">Welcome</h2>
        </div>
        <div class="mdl-card__supporting-text">

        </div>
    </div>
    <div id="chart_div"></div>


    <!-- scripts and css declaration -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var options = {
                'title': 'Jumlah Pemilihan',
                'width': 400,
                'height': 300
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

            //Mengecheck database secara terus menerus
            setInterval(function() {
                $.ajax({
                    url: "getQuickCount.php",
                    type: "POST",
                    async: true,
                    success: function(results) {
                        var split = results.split(';');
                        var data = google.visualization.arrayToDataTable([
                            ["Nama Calon", "Count"],
                            ["Calon 1", parseInt(split[0])],
                            ["Calon 2", parseInt(split[1])]
                        ], false);
                        chart.draw(data, options);
                    }
                });
            }, 1000);
        }
    </script>
</body>

</html>
