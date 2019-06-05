<?php
   include_once 'db_configuration.php';

   if (isset($_POST['movie_name']) && isset($_POST['year_made'])
       && isset($_POST['language']) && isset($_POST['lead_actor'])){

         $movie_name = mysqli_real_escape_string($db, $_POST['movie_name']);
         $year_made = mysqli_real_escape_string($db, $_POST['year_made']);
         $language = mysqli_real_escape_string($db, $_POST['language']);
         $lead_actor = mysqli_real_escape_string($db, $_POST['lead_actor']);
         $lead_actress = mysqli_real_escape_string($db, $_POST['lead_actress']);
         $director = mysqli_real_escape_string($db, $_POST['director']);
         $music_director = mysqli_real_escape_string($db, $_POST['music_director']);
         $other_cast = mysqli_real_escape_string($db, $_POST['other_cast']);
         $status = mysqli_real_escape_string($db, $_POST['status']);
         $image = mysqli_real_escape_string($db, $_POST['image']);

   $sql = "INSERT INTO movie_table (movie_name, year_made, language, lead_actor, lead_actress,
                             director, music_director, other_cast, status, image)
          VALUES('$movie_name','$year_made','$language','$lead_actor','$lead_actress','$director',
                 '$music_director','$other_cast','$status','$image' );";

          mysqli_query($db, $sql);
          header('location: movielist.php?MovieAdded=Success');
          exit;
   }//end if
   ?>
