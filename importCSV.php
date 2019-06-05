<?php
include_once 'db_configuration.php';

if(isset($_POST['submit'])){

  $clear = "TRUNCATE TABLE book";
  mysqli_query($db, $clear);

  $file = $_FILES['file']['tmp_name'];

  $handle = fopen($file,"r");

  while(($fileop = fgetcsv($handle, 1000, ",")) !== false){


    $movie_name = $fileop[1];
    $year_made = $fileop[2];
    $language = $fileop[3];
    $lead_actor = $fileop[4];
    $lead_actress = $fileop[5];
    $director = $fileop[6];
    $music_director = $fileop[7];
    $other_cast = $fileop[8];
    $status = $fileop[9];
    $image = $fileop[10];


        $sql = "INSERT INTO movie_table (movie_name, year_made, language, lead_actor,
                                  lead_actress, director, music_director, other_cast, status,
                                  image)
               VALUES('$movie_name','$year_made','$language','$lead_actor','$lead_actress',
                      '$director','$music_director','$other_cast','$status','$image' );";

               mysqli_query($db, $sql);
  }//end while

header('location: movielist.php?MoviesImported=Success');

}//end if

?>
