<?php
   require 'bin/functions.php';
   require 'db_configuration.php';
   session_start();

   $query = "SELECT *
             FROM publisher";

             $GLOBALS['publisher'] = mysqli_query($db, $query);
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Variable for Publishers Name and Logo -->
      <?php $pub_row = $publisher->fetch_assoc();?>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title><?php echo $pub_row["publisher_name"];?></title>
      <!-- Bootstrap core CSS -->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="css/publishersdb.css" rel="stylesheet">
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   </head>
   <body>
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
         <a class="navbar-brand" href="index.php">
         <?php
            $pub_img = "images/".$pub_row['logo'];
 
              echo $pub_row["publisher_name"];
            ?>
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

               <!-- Login / Logout Nav menu item
                  Checks if there is a valid session and if so displays "logout"
                  If there isn's a valid session display login. -->
               <li class="nav-item">
                  <?php
                     if (isset($_SESSION['type'])){
                     echo '<a class="nav-link" href="logout.php">Logout</a>';
                     }//end if
                     else{
                       echo '<a class="nav-link" href="loginForm.php">Login</a>';
                     }//end else
                     ?>
				<?php
               //Display Admin view if an admin is logged in.
               //This gives full access to all CRUD functions

                   if (isset($_SESSION['type'])){
                     if ($_SESSION['type'] == 'Admin'){
                     ?>
					<li class="nav-item">
					<a class="nav-link" href="admin.php">Admin</a>
					</li>
				<?php
               }//end if
               }//end if
               ?>
               </li>
               <!-- End Login / Logout Nav menu item -->
               <li class="nav-item">
            </ul>

            <ul class="navbar-nav mr-right">
               <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
               </li>

               </li>
            </ul>
         </div>
      </nav>
	  
	  
	  
      <!-- Page Content -->
      <div class="container">
		<br>
	     <h1 align="center"> Reports</h1>
		 <br>
         <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(publisherPieChart);

            <?php
               $query1 = "SELECT director, count(*) as number
                         FROM movie_table
                         GROUP BY director";
               $result1 = mysqli_query($db, $query1);
               ?>

              function publisherPieChart() {
                var publisherData = google.visualization.arrayToDataTable([
                  ['Director', 'Number'],
                    <?php
               while ($row = mysqli_fetch_array($result1)) {
                 echo "['".$row["director"]."', ".$row["number"]."],";
               }//end while
               ?>
                ]);

                var publisherOptions = {
                  title: 'Movies by Director',
                  is3D: true,
                };

                var publisherChart = new google.visualization.PieChart(document.getElementById('publisher_piechart_3d'));
                publisherChart.draw(publisherData, publisherOptions);
              }//end publisherChart

            //********************* Language Chart *******************************************
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(authorPieChart);

            <?php
               $query2 = "SELECT language, count(*) as number
                         FROM movie_table
                         GROUP BY language";
               $result2 = mysqli_query($db, $query2);
                ?>

            function authorPieChart() {
            var authorData = google.visualization.arrayToDataTable([
              ['Year', 'Number'],
                <?php
               while ($row2 = mysqli_fetch_array($result2)) {
                 echo "['".$row2["language"]."', ".$row2["number"]."],";
               }

               ?>
            ]);

            var authorOptions = {
              title: 'Movies by Language',
              is3D: true,
            };

            var authorChart = new google.visualization.PieChart(document.getElementById('author_piechart_3d'));
            authorChart.draw(authorData, authorOptions);
            }//end AuthorChart

            //*************************** Year Chart **************************************
              google.charts.load("current", {packages:['corechart']});
              google.charts.setOnLoadCallback(drawChart);

                <?php
               $query3 = "SELECT count(movie_name) AS count, year_made
                          FROM movie_table
                          GROUP BY year_made";
               $result3 = mysqli_query($db,$query3);
               ?>

               function drawChart() {
                  var priceData = google.visualization.arrayToDataTable([
                  ['Year Made', 'Count'],
                  <?php
               while($row3 = mysqli_fetch_array($result3)){
               echo "['".$row3['year_made']."',".$row3['count']."],";
               }
               ?>

                  ]);
                  var priceOptions = {
                  title: 'Year Movie was Made'
                  };
                  var priceChart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
                  priceChart.draw(priceData, priceOptions);
               }
         </script>
         <!-- Page Heading -->
         <div id="publisher_piechart_3d" style="width: 900px; height: 400px;"></div>
         <div id="author_piechart_3d" style="width: 900px; height: 400px;"></div>
         <div id="columnchart" style="width: 900px; height: 400px;"></div>
         <!-- Pagination -->
         <!--
         <ul class="pagination justify-content-center">
            <li class="page-item">
               <a class="page-link" href="#" aria-label="Previous">
               <span aria-hidden="true">&laquo;</span>
               <span class="sr-only">Previous</span>
               </a>
            </li>
            <li class="page-item">
               <a class="page-link" href="#">1</a>
            <li class="page-item">
               <a class="page-link" href="#" aria-label="Next">
               <span aria-hidden="true">&raquo;</span>
               <span class="sr-only">Next</span>
               </a>
            </li>
         </ul>
       -->
      </div>
      <!-- /.container -->
      <!-- Footer -->
      <footer class="py-5 bg-dark">
         <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; <?php echo $pub_row["publisher_name"];?> 2018</p>
         </div>
         <!-- /.container -->
      </footer>
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
