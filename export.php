<?php
include_once 'db_configuration.php';


  header('Content-Type: text/csv; charset=utf-8');
  header('Content-Disposition: attachment; filename=moviedbExport.csv');
  $output = fopen("php://output", "w");
  fputcsv($output, array('movie_id', 'movie_name', 'year_made', 'language',
                         'lead_actor', 'lead_actress', 'director', 'music_director', 'other_cast', 'status',
                         'image'));

  $query = "SELECT movie_id, movie_name, year_made, language, lead_actor, lead_actress,
                   director, music_director, other_cast, status, image
            FROM movie_table
            ORDER BY movie_id";

  $result = mysqli_query($db, $query);

  While($row = mysqli_fetch_assoc($result)){
    fputcsv($output, $row);
  }//end while

  fclose($output);

//  header('location: index.php?Export=Success');

//end if
?>
