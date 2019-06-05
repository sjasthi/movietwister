<?php
include_once 'db_configuration.php';

if (isset($_GET['id'])){

  $delete_id = $_GET['id'];

  $sql = "DELETE FROM movie_table
          WHERE movie_id = '$delete_id'";

  mysqli_query($db, $sql);
  header('location: movielist.php?Delete=Success');

}//end if
?>
