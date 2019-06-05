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
              echo '<img src="'.$pub_img.'" width="auto" height="35" class="d-inline-block align-top" alt="">';
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
	  
	        <div class="container">
				<br>
				<br>

	<div class="row">    
		<?php

			$once=0;
			$word="";
			$input="";
			$correct="";
			$answer="";
				if (isset($_GET["guess"])) {
				$track=htmlspecialchars($_GET['holder']);
				
				$once=1;
				
			}
			if (isset($_GET["guess"])) {
				$auto=htmlspecialchars($_GET['ans']);
				$answer=$auto;
				
			}
			
			if (isset($_GET["guess"])) {
				$puzzle=htmlspecialchars($_GET['anagram']);
				$word=$puzzle;
				
			}
			
			if (isset($_GET["guess"])) {
			
			$help  = htmlspecialchars($_GET['guess']);
			$input=$help;
			
		
		
			}
			
		?>		
			
    </div>
    <div class="row">
	
  
    


   <div class="row">
		
		 <div class="panel panel-primary" style="margin-top: 30px">
			<div class="Please enter the following settings">
				<form name="myForm" action="index.php" target="" method="get" role="form">
                <div class="row">
                    <div class="col-lg-12" style="margin-top: 20px" align="center">						
							
                            <div class="form-group">
							<h2 for="comment">Guess the Movie Name</h2>
							   <div class="form-group">
									<?php
									$word;
									$answer;
									
								if($once==0){	
    	$childArray = array();
	
		$result = $db->query("SELECT anagram FROM movies_anagram ORDER BY RAND() LIMIT 1") ;
		$word="";
if ($result ->num_rows !=0){
 while ($rows = $result->fetch_assoc() ) {
	 $word=$rows['anagram'];
 echo "<p align='center'> <font color=black  size='48pt'>$word</font> </p>";
echo "<br>";
 }
}

	$master = $db->query("SELECT movie_id FROM movies_anagram Where anagram = '".$word."'  ");    
$hold;
	

    
    while ($row = $master->fetch_assoc()) {
		
        $hold= $row["movie_id"];
	
$result = $db->query("SELECT movie_name FROM movies_info Where (movie_id = '".$hold."') ");    

	

   
	
    while ($ans = $result->fetch_assoc()) {
			
        $answer= $ans["movie_name"];
	
		
		
    }
		
    }
        mysqli_free_result($master);
		
    }


if($once==1){
	
	
		function is_correct($a, $b)
 {
	 	 
       if ($a == $b)
    {
		$right='Congratulations, you guessed right';
	echo $right;
	echo "<br>";
	?>
	
	<a href="index.php"><button type="button"  class="btn btn-primary">Next anagram</button></a>
	<?php
	return true;
        
		
    }
    else
    {
		$error='You guessed Wrong, Try again';
	echo $error;

		
        return false;
    }
 }

	if (is_correct($input, $answer)== true){
	echo "<p align='center'> <font color=black  size='48pt'>$answer</font> </p>";
}
else{
	echo "<p align='center'> <font color=black  size='48pt'>$word</font> </p>";
	
}
}

	

									
 //This is where guess php started

		
	
		 
		 

	
	
		
    ?>
								
								
                                <input type="text" name="guess" class="form-control" rows="2" id="guess" style="margin:0%" placeholder="Take a guess"></input>
							<input type="hidden" name="anagram" class="form-control" rows="2" id="anagram" style="margin:0%" value="<?php echo $word ; ?>"></input>
							<input type="hidden" name="holder" class="form-control" rows="2" id="holder" style="margin:0%" value="<?php echo $once ; ?>"></input>
							<input type="hidden" name="ans" class="form-control" rows="2" id="ans" style="margin:0%" value="<?php echo $answer ; ?>"></input>

                                <div style="margin-top: 10px">                                    
									<input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>




                    </div>
                </div>

              
            </form>
			</div>
		</div>
        
    </div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/puzzle.js"></script>
	  
	  
	  </div>
		
         <!-- /.container -->
      </footer>
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   </body>
</html>
