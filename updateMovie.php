<?php
   require 'bin/functions.php';
   require 'db_configuration.php';
   session_start();


     $query = "SELECT *
               FROM movie_table";


               $GLOBALS['gridResults'] = mysqli_query($db, $query);


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
      <!-- Page Content -->
	  
	  <br>
	  <br>
<div class="container">
	  <?php
  include_once 'db_configuration.php';

  if (isset($_GET['id'])){

    $update_id = $_GET['id'];

    $sql = "SELECT * FROM movie_table
            WHERE movie_id = '$update_id'";

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
  }//end if

  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
            echo '<form class="form" action="update.php" method="POST">
              Movie ID: <br> <input type="text" name="movie_id" value="'.$row["movie_id"].'" maxlength="3" readonly> <br>
              Movie Name: <br> <input type="text" name="movie_name" value="'.$row["movie_name"].'" maxlength="255" required> <br>
              Year Made: <br> <input type="text" name="year_made" value="'.$row["year_made"].'"  maxlength="255" required> <br>
              Language: <br> <input type="text" name="language" value="'.$row["language"].'"  maxlength="4" required> <br>
              Lead Actor: <br> <input type="text" name="lead_actor" value="'.$row["lead_actor"].'"  maxlength="255"> <br>
              Lead Actress: <br> <input type="text" name="lead_actress" value="'.$row["lead_actress"].'"  maxlength="4"> <br>
              Director: <br> <input type="text" name="director" value="'.$row["director"].'"  maxlength="255"> <br>
              Music Director: <br> <input type="text" name="music_director" value="'.$row["music_director"].'"  maxlength="10"> <br>
              Other Cast: <br> <input type="text" name="other_cast" value="'.$row["other_cast"].'"  maxlength="14"> <br>
              Image: <br> <input type="text" name="image" value="'.$row["image"].'"  maxlength="255"> <br>
				<br>

              <button type="submit" name="submit" class="btn btn-success btn-sm">Update Movie<button>
            </form>';

      }//end while
  }//end if
  else {
      echo "0 results";
  }//end else

?>
	  
	  
	  
</div>	  
	  
         <!-- /.container -->
      </footer>
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
