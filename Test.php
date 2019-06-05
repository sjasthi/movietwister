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
                  <a class="nav-link" href="#">Movies <span class="sr-only">(current)</span></a>
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
         <div id="adminTableView">
            <div class="input-group">
               <span class="input-group-btn">
               <button style="margin-right:200px;" onclick="displayBookFields('bookFields');" type="button"
                  class="btn btn-outline-secondary btn-sm">Add a Movie</button>
               <button style="margin-left:175px;"onclick="displayBookFields('bulkFields');" type="button" align="right"
                  class="btn btn-outline-secondary btn-sm">Bulk Import Movies</button>
               </span>
               <form  action="export.php" method="POST">
                  <button type="submit" name="export" class="btn btn-outline-secondary btn-sm" style="margin-left:390px;">Export Database</button>
               </form>
            </div>
            <div id="bookFields">
               <form class="form" action="addmovie.php" method="POST">
                  Publisher: <br> <input type="text" name="publisher" placeholder="Required" maxlength="255" required> <br>
                  Book Name: <br> <input type="text" name="bookName" placeholder="Required" maxlength="255" required> <br>
                  Author: <br> <input type="text" name="author" placeholder="Required" maxlength="255" required> <br>
                  Stock: <br> <input type="text" name="stock" placeholder="Required" maxlength="4" required> <br>
                  Series: <br> <input type="text" name="series"  maxlength="255"> <br>
                  Pages: <br> <input type="text" name="pages"  maxlength="4"> <br>
                  Genre: <br> <input type="text" name="genre"  maxlength="255"> <br>
                  ISBN 10: <br> <input type="text" name="isbn10"  maxlength="10"> <br>
                  ISBN 13: <br> <input type="text" name="isbn13"  maxlength="14"> <br>
                  Language: <br> <input type="text" name="language"  maxlength="255"> <br>
                  Price: <br> <input type="text" name="price" maxlength="6"> <br>
                  Published Date: <br> <input type="date" name="publishedDate"> <br>
                  Book Image: <br> <input type="file" name="image" maxlength="75"> <br> <br>
                  <button type="submit" name="submit" class="btn btn-success btn-sm">Add Book</button>
               </form>
            </div>
            <div id="bulkFields">
               <form class="form" action="importBooksCSV.php" method="POST" enctype="multipart/form-data">
                  Bulk Book Upload File (.CSV): <br> <input type="file" name="file" maxlength="75" required> <br> <br>
                  <button type="submit" name="submit" class="btn btn-success btn-sm">Import</button>
               </form>
            </div>
            <table class="table table-striped">
               <div class="table responsive">
                  <thead>
                     <tr>
                        <th> </th>
                        <th>Movie Name</th>
                        <th>Year Made</th>
                        <th>Language</th>
                        <th>Lead Actor</th>
                        <th>Lead Actress</th>
                        <th>Director</th>
                        <th>Music Director</th>
                        <th>Other Cast</th>
                        <th>Status</th>

                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        if ($tableResults->num_rows > 0) {
                            // output data of each row
                            while($row = $tableResults->fetch_assoc()) {
                              $img = "images/".$row['image'];
                                echo '<tr>
                                          <td> <img src="'.$img.'" alt="" width="50px" height="50px"/> </td>
								
                                          <td> '.$row["movie_name"].'</td>
                                          <td> '.$row["year_made"]. '</td>
                                          <td> '.$row["language"]. '</td>
                                          <td> '.$row["lead_actor"]. '</td>
                                          <td> '.$row["lead_actress"]. '</td>
                                          <td> '.$row["director"]. '</td>
                                          <td> '.$row["music_director"]. '</td>
                                          <td> '.$row["other_cast"].' </td>
                                          <td> '.$row["status"].' </td>
                                          <td><a class="btn btn-danger btn-sm" >Delete</a></td>
                                          <td><a class="btn btn-warning btn-sm" href="updateMovie.php?id='.$row["movie_id"].'">Update</a></td>
                                        </tr>';

                            }//end while
                        }//end if
                        else {
                            echo "0 results";
                        }//end else
                        ?>
                  </tbody>
               </div>
            </table>
         </div>
         <div id="customerTableView">
            <table class="table table-striped">
               <div class="table responsive">
                  <thead>
                     <tr>
                        <th> </th>
                        <th>Movie Name</th>
                        <th>Year Made</th>
                        <th>Language</th>
                        <th>Lead Actor</th>
                        <th>Lead Actress</th>
                        <th>Director</th>
                        <th>Music Director</th>
                        <th>Other Cast</th>
                        <th>Status</th>

                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        if ($customerTableResults->num_rows > 0) {
                            // output data of each row
                            while($row = $customerTableResults->fetch_assoc()) {

                              $img = "images/".$row['image'];

                                echo '<tr>
                                          <td> <img src="'.$img.'" alt="" width="50px" height="50px"/> </td>
								
										  <td> '.$row["movie_name"].'</td>
                                          <td> '.$row["year_made"]. '</td>
                                          <td> '.$row["language"]. '</td>
                                          <td> '.$row["lead_actor"]. '</td>
                                          <td> '.$row["lead_actress"]. '</td>
                                          <td> '.$row["director"]. '</td>
                                          <td> '.$row["music_director"]. '</td>
                                          <td> '.$row["other_cast"].' </td>
                                          <td> '.$row["status"].' </td>
                                          <td><a class="btn btn-danger btn-sm" >Delete</a></td>
                                          <td><a class="btn btn-warning btn-sm" href="updateMovie.php?id='.$row["movie_id"].'" >Update</a></td>

                                        </tr>';

                            }//end while
                        }//end if
                        else {
                            echo "0 results";
                        }//end else
                        ?>
                  </tbody>
               </div>
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
         <ul class="pagination justify-content-center">
            <li class="page-item">
               <a class="page-link" href="#" aria-label="Previous">
               <span aria-hidden="true">&laquo;</span>
               <span class="sr-only">Previous</span>
               </a>
            </li>
            <li class="page-item">
               <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
               <a class="page-link" href="#" aria-label="Next">
               <span aria-hidden="true">&raquo;</span>
               <span class="sr-only">Next</span>
               </a>
            </li>
         </ul>
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
