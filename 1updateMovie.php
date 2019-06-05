<!DOCTYPE html>


<html lang="en">



  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Update Movie</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../ccs/publishersdb.css" rel="stylesheet">
	
	

  </head>
  
  
  
  <body>
  


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



  </body>
</html>
