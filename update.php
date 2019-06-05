<?php
include_once 'db_configuration.php';

if (isset($_POST['movie_id'])){

  $movie_id = mysqli_real_escape_string($db, $_POST['movie_id']);
  $movie_name = mysqli_real_escape_string($db, $_POST['movie_name']);
  $year_made = mysqli_real_escape_string($db, $_POST['year_made']);
  $language = mysqli_real_escape_string($db, $_POST['language']);
  $lead_actor = mysqli_real_escape_string($db, $_POST['lead_actor']);
  $lead_actress = mysqli_real_escape_string($db, $_POST['lead_actress']);
  $director = mysqli_real_escape_string($db, $_POST['director']);
  $music_director = mysqli_real_escape_string($db, $_POST['music_director']);
  $other_cast = mysqli_real_escape_string($db, $_POST['other_cast']);
  $image = mysqli_real_escape_string($db, $_POST['image']);




$sql = "UPDATE movie_table
        SET movie_name = '$movie_name',
            year_made = '$year_made',
            language = '$language',
            lead_actor = '$lead_actor',
            lead_actress = '$lead_actress',
            director = '$director',
            music_director = '$music_director',
            other_cast = '$other_cast',
            image = '$image'
          WHERE movie_id = '$movie_id'";

       mysqli_query($db, $sql);
       header('location: movielist.php?Movie Updated=Success');
}//end if
?>
