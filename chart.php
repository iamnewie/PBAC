<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <?php
        session_start();
        if (!isset($_SESSION['userId'])) {
            echo "<script type=\"text/javascript\">location.href='login.php'</script>";
        }
    ?>
</head>

<body>

    <div id="chart_div"></div>

    <!-- scripts and css declaration -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>

    <script>if(typeof($.fn.modal) === 'undefined') {document.write('<script src="/local/bootstrap.min.js"><\/script>')}</script>

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
