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

		
            </ul>
         </div>
      </nav>
				<br>
	  <h1 align="center"> Add Movie </h1>

	        <div class="container">
				<br>
				<br>

               <form class="form" action="addMovie.php" method="POST">
                  Movie Name: <br> <input type="text" name="movie_name" placeholder="Required" maxlength="255" required> <br>
                  Year Made: <br> <input type="text" name="year_made" placeholder="Required" maxlength="255" required> <br>
                  Language: <br> <input type="text" name="language" placeholder="Required" maxlength="255" required> <br>
                  Lead Actor: <br> <input type="text" name="lead_actor" placeholder="Required" maxlength="255" required> <br>
                  Lead Actress: <br> <input type="text" name="lead_actress"  maxlength="255"> <br>
                  Director: <br> <input type="text" name="director"  maxlength="255"> <br>
                  Music Director: <br> <input type="text" name="music_director"  maxlength="255"> <br>
                  Other Cast: <br> <input type="text" name="other_cast"  maxlength="255"> <br>
                  Status: <br> <input type="text" name="status"  maxlength="14"> <br>
                  Movie Image: <br> <input type="file" name="image" maxlength="75"> <br> <br>
                  <button type="submit" name="submit" class="btn btn-success btn-sm">Add Movie</button>
               </form>
            </div>
	  
	  
	  </div>
		
         <!-- /.container -->
      </footer>
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
