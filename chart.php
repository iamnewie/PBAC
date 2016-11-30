<html>
	<head>

    <?php
        /*session_start();
        if (!isset($_SESSION['userId'])) {
            echo "<script type=\"text/javascript\">location.href='login.php'</script>";
        }*/
    ?>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">

        var countCalonSatu = 0;
        var countCalonDua = 0;


      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

          var jsonData = $.ajax({
          url: "getQuickCount.php",
          dataType: "json",
          async: false
          }).responseText;

        // Create the data table.
        var data = new google.visualization.DataTable(jsonData);

        // Set chart options
        var options = {'title':'Jumlah Pemilihan',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

        /*var handler(){
            var ajaxRequest = new XMLHttpRequest(); // The variable that makes Ajax possible!
            ajaxRequest.onreadstatechage = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText.length > 0){
                        var split = this.responseText.split(";");
                        data. countCalonSatu = parseInt(split[0]);
                        countCalonDua = parseInt(split[1]);
                        document.getElementById("test").innerHTML = this.responseText;
                    }
                    else {
                        document.getElementById("test").innerHTML = "Fail";
                    }
                }
            };
            xmlhttp.open("GET", "getQuickCount.php", true);
            xmlhttp.send();
        }
        google.visualization.events.addListener(chart, 'ready', selectHandler);*/

        chart.draw(data, options);
    }
    </script>
	</head>

	<body>
        <div id="test"></div>
		<div id="chart_div"></div>
	</body>
</html>
