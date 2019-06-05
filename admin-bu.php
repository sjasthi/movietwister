<?php
   require 'bin/functions.php';
   require 'db_configuration.php';
   session_start();

   if(isset($_POST['submit-search'])){
     $search = mysqli_real_escape_string($db, $_POST['search']);
     $query = "SELECT *
             FROM movie_table
             WHERE id LIKE '%$search%'
             OR movie_name LIKE '%$search%'
             OR year_made LIKE '%$search%'";

             $GLOBALS['tableResults'] = mysqli_query($db, $query);
             $GLOBALS['customerTableResults'] = mysqli_query($db, $query);
             $GLOBALS['gridResults'] = mysqli_query($db, $query);
   }//end if

   else{
     $query = "SELECT *
               FROM movie_table";

               $GLOBALS['tableResults'] = mysqli_query($db, $query);
               $GLOBALS['customerTableResults'] = mysqli_query($db, $query);
               $GLOBALS['gridResults'] = mysqli_query($db, $query);
   }//end else

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
	
	  
	  
   </head>
   <body onload="displayAdminFields('admin1')">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
         <a class="navbar-brand" href="#">
         <?php
            $pub_img = "images/".$pub_row['logo'];
              echo '<img src="'.$pub_img.'" width="auto" height="35" class="d-inline-block align-top" alt="">';
              echo $pub_row["publisher_name"];
            ?>
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                  <a class="nav-link" href="movielist.php">Movies <span class="sr-only">(current)</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="Reports.php">Reports</a>
               </li>
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
               </li>
               <!-- End Login / Logout Nav menu item -->
               <li class="nav-item">

            </ul>
            <form class="form-inline my-2 my-lg-0" action="index.php" method="POST">
               <input class="form-control mr-sm-2" type="search" type="text" name="search" placeholder="Search">
               <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="submit-search">Search</button>
            </form>
            <ul class="navbar-nav mr-right">
               <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#">Contact</a>
               </li>
               </li>
            </ul>
         </div>
      </nav>
      <!-- Page Content -->
      <div class="container">
	  
	  
	              <?php
               //Display Admin view if an admin is logged in.
               //This gives full access to all CRUD functions

                   if (isset($_SESSION['type'])){
                     if ($_SESSION['type'] == 'Admin'){
                     ?>
            <style type="text/css">#adminTableview{
               display:block;
               }
            </style>
            <style type="text/css">#customerTableView{
               display:none;
               }
            </style>
            <style type="text/css">#selector{
               display:none;
               }
            </style>
            <?php
               }//end if
               }//end if
               ?>
	  
	  
	  
	  
	  
	  <br>
	  
      <div id="adminTableView">
	  <h1 align="center">Admin Actions</h1>
	  
	  
      <br>
	  <table align="center" class="adminTable">
        <td align="center">
            <a href="anagram_puzzle.php"><img src="./icons/puzzle.png" class="adminThumbnailSize"></a>
        </td>

 <!--       <td align="center">
            <a href="add_movie.php"><img src="./icons/add.png" class="adminThumbnailSize"></a>
        </td>   -->
        <td align="center">
            <a href="movielist.php"><img src="./icons/list.png" class="adminThumbnailSize">
        </td>
		
		<td align="center">
            <a href="export.php"><img src="./icons/export.png" class="adminThumbnailSize">
        </td>
        <td align="center">
            <a href="importCSV.php"><img src="./icons/import.png" class="adminThumbnailSize"></a>
        </td>
        <td align="center">
            <a href="reports.php"><img src="./icons/report.png" class="adminThumbnailSize"></a>
        </td>

        
    </tr>
    <tr>
		<td align="center"><a href="anagram_puzzle.php">Go To Puzzle</a></td>
  <!--      <td align="center"><a href="add_movie.php">Add Movie</a></td>  -->
        <td align="center"><a href="movielist.php">Movie List</a></td>
 		<td align="center"><a href="export.php">Export List</a></td>
		<td align="center"><a href="importCSV.php">Mass Import List</a></td>
        <td align="center"><a href="reports.php">Reports</a></td>

        
    </tr>
    <tr class="separator">
        <td></td>
    </tr>



	</table>
	  
	</div>  
	  
     <div id="customerTableView">
	  <h1 align="center">Actions</h1>
	  
	  
      <br>
	  <table align="center" class="adminTable">
        <td align="center">
            <a href="anagram_puzzle.php"><img src="./icons/puzzle.png" class="adminThumbnailSize"></a>
        </td>


        <td align="center">
            <a href="movielist.php"><img src="./icons/list.png" class="adminThumbnailSize">
        </td>

        <td align="center">
            <a href="reports.php"><img src="./icons/report.png" class="adminThumbnailSize"></a>
        </td>

        
    </tr>
    <tr>
		<td align="center"><a href="anagram_puzzle.php">Go To Puzzle</a></td>

        <td align="center"><a href="movielist.php">Movie List</a></td>
 
        <td align="center"><a href="reports.php">Reports</a></td>

        
    </tr>
    <tr class="separator">
        <td></td>
    </tr>



	</table>
	  
	</div>  	  
	  
	  
	  </div>
		
         <!-- /.container -->
      </footer>
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
