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
      <div class="container">
         <!-- Page Heading -->
         <h1 class="my-4">
            <?php
               //Display Admin view if an admin is logged in.
               //This gives full access to all CRUD functions
                  echo 'Movies ';
                   if (isset($_SESSION['type'])){
                     if ($_SESSION['type'] == 'Admin'){
                     echo '- Admin Maintenance Mode';
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
            <div id="selector" class="btn-group">
               <button onclick="toggleview('customerTableView');" type="button" class="btn btn-secondary">Table</button>
               <button onclick="toggleview('gridView');" type="button" class="btn btn-secondary">Grid</button>
               <!-- Display a clear button if displaying search results. -->
               <?php
                  if(isset($_POST['submit-search'])){
                  echo ' <form class="form-inline my-2 my-lg-0" action="index.php" method="POST">
                  <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" name="clear-search">Clear Search</button>
                  </form>';
                  }//end if
                  ?>
            </div>
         </h1>
		 
		 
		 
            <table class="table table-striped" id="table_id">

                  <thead>
				  

                     <tr>
 						<th>Movie ID</th>
                        <th>Movie Name</th>
                        <th>Year Made</th>
                        <th>Language</th>
                        <th>Lead Actor</th>
                        <th>Lead Actress</th>
                        <th>Director</th>
                        <th>Music Director</th>
                        <th>Other Cast</th>
                        <th>Status</th>
						<th>Image Name</th>

                     </tr>
                  </thead>
                  <tbody>
				  <?php
					$query = "SELECT * FROM movie_table";
					$stmt = $db->prepare($query);
					//$stmt->bind_param('s', $searchterm);  
					$stmt->execute();
					$stmt->store_result();

						$stmt->bind_result($movie_id, $movie_name, $year_made, $language, $lead_actor, $lead_actress, $director, $music_director, $other_cast, $status, $image);
	
		
			echo "\t<th>Movie ID</th>\n";				
			echo "\t<th>Movie Name</th>\n";
			echo "\t<th>Year Made</th>\n";
			echo "\t<th>Language</th>\n";
			echo "\t<th>Lead Actor</th>\n";
			echo "\t<th>Lead Actress</th>\n";
			echo "\t<th>Director</th>\n";
			echo "\t<th>Music Director</th>\n";
			echo "\t<th>Other Cast</th>\n";
			echo "\t<th>Status</th>\n";
			echo "\t<th>image</th>\n";

   
		while($stmt->fetch()) {				
					
					echo "<tr>\n";

						echo "\t<td>".$movie_id."<input type='hidden' id='$movie_id' name='movie_id' value='".$movie_id."' size='0';'/></a></td>\n";
						echo "\t<td>".$movie_name."</a><input type='hidden' id='$movie_id' name='movie_name' value='".$movie_name."' size='0';'/></td>\n";
						echo "\t<td>".$year_made."</a><input type='hidden' id='$movie_id' name='year_made' value='".$year_made."' size='0';'/></td>\n";
						echo "\t<td>".$language."</a><input type='hidden' id='$movie_id' name='language' value='".$language."' size='0';'/></td>\n";
						echo "\t<td>".$lead_actor."</a><input type='hidden' id='$movie_id' name='lead_actor' value='".$lead_actor."' size='0';'/></td>\n";
						echo "\t<td>".$lead_actress."</a><input type='hidden' id='$movie_id' name='lead_actress' value='".$lead_actress."' size='0';'/></td>\n";
						echo "\t<td>".$director."</a><input type='hidden' id='$movie_id' name='director' value='".$director."' size='0';'/></td>\n";
						echo "\t<td>".$music_director."</a><input type='hidden' id='$movie_id' name='music_director' value='".$music_director."' size='0';'/></td>\n";
						echo "\t<td>".$other_cast."</a><input type='hidden' id='$movie_id' name='other_cast' value='".$other_cast."' size='0';'/></td>\n";
						echo "\t<td>".$status."</a><input type='hidden' id='$movie_id' name='status' value='".$status."' size='0';'/></td>\n";
						
						echo "\t<td>";
						echo "<input type='image' src='images/".$image."' name='image' value='".$image."' style='width:52px;'>";

						echo "\t<td>";
						echo "<input onclick='checkDelete(this)' type='image' src='delete.png' name='id' value='".$movie_id."'  alt='submit' style='width: 22px;'>";
						echo "<input onclick='update(this)' type='image' src='edit.png' name='id' value='".$movie_id."'  alt='submit' style='width: 22px;'>";
						

						}
						
						

				
                        ?>
				  
                  </tbody>
		   
			<tfoot>
				<tr>
 						<th>Movie ID</th>
                        <th>Movie Name</th>
                        <th>Year Made</th>
                        <th>Language</th>
                        <th>Lead Actor</th>
                        <th>Lead Actress</th>
                        <th>Director</th>
                        <th>Music Director</th>
                        <th>Other Cast</th>
                        <th>Status</th>
						<th>Image Name</th>
				</tr>
			</tfoot>
            </table>
         </div>

		 
         <div id="gridView">
            <?php
               $rows = $gridResults->num_rows;    // Find total rows returned by database
               if($rows > 0) {
                 $cols = 3;    // Define number of columns
                 $counter = 1;     // Counter used to identify if we need to start or end a row
                 $nbsp = $cols - ($rows % $cols);    // Calculate the number of blank columns

                 $container_class = 'container-fluid';  // Parent container class name
                 $row_class = 'row';    // Row class name
                 $col_class = 'col-md-4'; // Column class name

                 echo '<div class="'.$container_class.'">';    // Container open
                 while ($item = $gridResults->fetch_array()) {
                   if(($counter % $cols) == 1) {    // Check if it's new row
                     echo '<div class="'.$row_class.'">';	// Start a new row
                   }
                       $img = "images/".$item['image'];

                       echo
                       '<div class="'.$col_class.'">
                           <img src="'.$img.'" alt="'.$item['movie_name'].'"/>
                           <h6 style="font-size:14px;"> Title: '.$item['movie_name'].'</h6>
                           <h6 style="font-size:14px;"> Director: '.$item['director'].'  </h6>
                           <h6 style="font-size:14px;"> Lead Actor: '.$item['lead_actor'].'  </h6>
                           <h6 style="font-size:14px;"> Lead Actress: '.$item['lead_actress'].'  </h6>
                           <h6 style="font-size:14px;"> Language: '.$item['language'].'  </h6>
                           <button type="button" class="btn btn-primary btn-sm"> Update </button>
                           <button type="button" class="btn btn-primary btn-sm"> Delete </button>                           
						   <br> </br>
                           <br> </br>
                       </div>';    // Column with content

                   if(($counter % $cols) == 0) { // If it's last column in each row then counter remainder will be zero
                     echo '</div>';	 //  Close the row
                   }
                   $counter++;    // Increase the counter
                 }
                 $gridResults->free();
                 if($nbsp > 0) { // Adjustment to add unused column in last row if they exist
                   for ($i = 0; $i < $nbsp; $i++)	{
                     echo '<div class="'.$col_class.'">&nbsp;</div>';
                   }
                   echo '</div>';  // Close the row
                 }
                     echo '</div>';  // Close the container
               }
               ?>
         </div>
         <!-- Pagination -->

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
	  
	  
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">	


	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>


  
<script type="text/javascript">
    $(document).ready(function () {
        $('#table_id').dataTable({
		
        dom: 'lBfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
    });
	
	
function checkDelete(movie){
    var r = confirm('Are you sure you would like to delete ' + movie.value + '?');
			if (r == true) {
				window.location="delete.php?id=" + movie.value;
			} else {
				
			}
}
	
function update(movie){

				window.location="updateMovie.php?id=" + movie.value;

}	
	
</script>
	  
   </body>
</html>
