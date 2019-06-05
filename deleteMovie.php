<?php
include_once 'db_configuration.php';

if (isset($_GET['id'])){

  $delete_id = $_GET['id'];

  $sql = "DELETE FROM book
          WHERE ID = '$delete_id'";

  mysqli_query($db, $sql);
  header('location: movielist.php?DeleteBook=Success');

}//end if
?>
