

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/main_style.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
	 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <title>Movie Anagram Master List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
		<link href="css/2bootstrap.min.css" rel="stylesheet">
	<link href="css/2style.css" rel="stylesheet">
	

   
</head>


<body class="body_background">

<div id="wrap">

    <div class="container">
	<br>
	<h1 align-center>Anagrams List</h1>
	<br>
	<br>
        

        <table id="info" cellpadding="10" cellspacing="10" border="10" class="datatable table table-striped table-bordered" width="100%">

            <thead>

            <tr>
				<th>Movie ID</th>
                <th>Movie Name</th>
				<th>Anagrams</th>
                <th>Actions</th>

            </tr>

            </thead>

            <tbody>





            <?php

            require 'db_configuration2.php';
			include 'header.php';

	$query = "SELECT movie_table.movie_id, movie_name
				FROM movies_anagram,movie_table 
				Group By movie_table.movie_id " ;
			
	$stmt = $db->prepare($query);
	//$stmt->bind_param('s', $searchterm);  
	$stmt->execute();
	$stmt->store_result();
	
	$stmt->bind_result($puzzleId, $puzzleWord);
	

	
		
   
		while($stmt->fetch()) {				
					$hold=0;
					$aHold=0;
					echo "<tr>\n";
						echo "<form action='add_movie_anagram.php' method='post'>\n";
						echo "\t<td>".$puzzleId."<input type='hidden' id='$puzzleId' name='puzzleId' value='".$puzzleId."' size='0';'/></a></td>\n";
						
						
						
						echo "\t<td>".$puzzleWord."</a><input type='hidden' id='$puzzleId' name='puzzleWord' value='".$puzzleWord."' size='0';'/></td>\n";
						echo "\t<td>";
						
						
						$anagramList = $db->query(" SELECT anagram 
													FROM movies_anagram 
													Where movie_id= (SELECT movie_id 
																	 FROM movie_table 
																	 WHERE movie_name ='".$puzzleWord."') ");   


	$help=0;
    
   
    while ($row = $anagramList->fetch_assoc()) {
			if($help>0){
		
		echo ", ";
					   }//END OF WHILE STAT
        printf ($row["anagram"]);
	
		
		$help++;
     											}//END OF WHILE STATEMENT
	echo "\t<td>";


						
				$childAnagram = $db->query(" SELECT anagram 
											 FROM movies_anagram 
											 WHERE movie_id =(SELECT movie_id 
												 			  FROM movie_table
															  WHERE movie_name = '".$puzzleWord."') ");

   

						if(isset($_SESSION["type"])){
												if($_SESSION["type"] == 'Admin'){
						echo "<input onclick='update(this)' type='image' src='edit.png' name='id' value='".$puzzleId."'  alt='submit' style='width: 32px;'>";
												}
						}
						echo "\t</form>";
					if(isset($_SESSION["type"])){
												if($_SESSION["type"] == 'Admin'){
						echo "<input onclick='deletePuzzle(this)' type='image' name='id' value='".$puzzleId."'src='delete.png' style='width: 32px;'>";
												}
						}
						
						//echo "\t<input onclick='playPuzzle(this)' type='image' name='".$puzzleWord."' value='".$puzzleId."' src='play.jpg' style='width: 22px;'></td>\n";
						echo "";
						
				echo "</tr>\n"; 
			}
				
			

            ?>

            </tbody>

            <tfoot>

            <tr>

                <th>Movie ID</th>
                <th>Movie Name</th>
				<th>Anagrams</th>
                <th>Actions</th>

            </tr>

            </tfoot>

        </table>

    </div>

</div>
      <footer class="py-5 bg-dark">
         <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; </p>
				
         </div>
         <!-- /.container -->
      </footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>



<script type="text/javascript">

    $(document).ready(function() {

        $('#info').DataTable(
			{
							        dom: 'Bfrtip',
							        buttons: [
							            'copy', 'csv', 'excel', 'pdf', 'print'
							        ]
							    }
        );

    });
	
	function deletePuzzle(puzzle) {
			//alert(puzzle.value);
			var r = confirm("Would like to delete the movie with the ID:  " + puzzle.value + "?");
			if (r == true) {
				window.location="delete_masterword.php?id=" + puzzle.value;
			} else {
				
			}
		}


</script>
		
		  <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js">
		  	</script>
		  
	  
		  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
		  	</script>
		  
		  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js">
			  	</script>
			  
			  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js">
				  	</script>
				  
				<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
					  	</script>
					  
			 <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js">
						  	</script>
						  
			 <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js">
							  	</script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js">
								  	</script>
				 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js">
									  	</script>
									  
			

</body>

</html>



