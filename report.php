<?php
   require 'bin/functions.php';
   require 'db_configuration.php';

   ?>
   
  <html>
  <head>
  <title>REPORTS</title>

  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Movies', 'Expenses', 'Profit'],

		  <?php
		  if(mysqli_num_rows($results) > 0){
			  
			  while($row = mysqli_fetch_array($result)){
				  echo "['".$row['year_made']."','".$row['movie_name']."',]"
			  }
			  
		  }
		  
	  }
		  ?>
		  
		  
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  


	  
 </head>
 
 <body>

 
 <div id="barchart_material" style="width: 900px; height: 500px;"></div>

 
 
 </body>
 
 
 
 </html>