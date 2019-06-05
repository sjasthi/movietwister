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
  <body>
	<div class="container">
		<div class="row">    
			<?php
				

				
			?>		
				
		</div>
		<?php

		
	
        //This PHP code block will be to get the data from the database to create the puzzle.
            //It handles both situations where the puzzle already exists or if it doesn't.
        $id = htmlspecialchars($_POST['puzzleId']);
		$inputWord = htmlspecialchars($_POST['puzzleWord']);
		
		
        //echo 'For debugging: <br>';
        //echo $inputWord . "<br>";
		/*
        $query = "SELECT * FROM movies_anagram WHERE anagram = '".$inputWord."'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $numOfRows = $stmt->num_rows;
        $stmt->bind_result($id, $movieid, $word);
    */
        //These 3 arrays are what is used to create the puzzle
        //intialization:
		
		$query = "SELECT * FROM movies_anagram WHERE movie_id = '".$id."'";
		$stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $numOfRows = $stmt->num_rows;
        $stmt->bind_result($id,$movieid, $word);
		
		
		
	
		
		
    ?>
	
	
		<div class="row">
			<h1>Add Movie Anagram </h1>	
			<hr />
			
			<div class="" style="margin-top: 30px">
				<div class="Please enter the following settings">
			<form class="contact" action="add_movieDB.php" target="" method="post" role="form">
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 20px" align="center">						
							
                            <div class="form-group">
									<?php
    
		 echo "<p align='center'> <font color='black'  size='36pt'>$inputWord</font> </p>";
		
		
    ?>

								
                                
								 <input type="hidden" name="parent" class="form-control" rows="2" id="comment" style="margin:0%" value="<?php echo $id ; ?>"></input>
								 <input type="hidden" name="masterWord" class="form-control" rows="2" id="comment" style="margin:0%" value="<?php echo $inputWord ; ?>"></input>
								 <textarea name="anagrams" rows="10" cols="100"><?php 		$anagramList = $db->query("SELECT anagram FROM movies_anagram Where movie_id =(SELECT movie_id from movie_table WHERE  movie_name = '".$inputWord."' ) ");    



    
    while ($row = $anagramList->fetch_assoc()) {
        printf ($row["anagram"]);
		echo "\n";
		
	};?></textarea>
								  

                                <div style="margin-top: 10px">                                    
									<input type="submit" class="btn btn-primary" value="Next">
                                </div>
					
						
				</div>			
			</div>		
		</div>
	</div>	
    
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/puzzle.js"></script>
  </body>
</html>