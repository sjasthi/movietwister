<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
    <title>Anagram Puzzler Word List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
		<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	

   
<body class="body_background">

<div id="wrap">

    <div class="container">

        

        <table id="info" cellpadding="10" cellspacing="10" border="10" class="datatable table table-striped table-bordered" width="100%">

            <thead>

            <tr>
				<th>Puzzle ID</th>

                <th>Puzzle</th>
				<th>Actions</th>
			

            </tr>

            </thead>

            <tbody>
	<?php  
	  require 'db_configuration2.php';
		include 'header.php';
	$query = "SELECT * FROM movies_anagram";
	$stmt = $db->prepare($query);
	//$stmt->bind_param('s', $searchterm);  
	$stmt->execute();
	$stmt->store_result();

	$stmt->bind_result($puzzleId, $puzzleParent, $puzzleWord);
	
		
			echo "<tr>\n";				
			echo "\t<th>Puzzle ID</th>\n";
			echo "\t<th>Puzzle</th>\n";
			echo "\t<th>Actions</th>\n";
			echo "</tr>\n";
   
		while($stmt->fetch()) {				
					
					echo "<tr>\n";
						echo "<form action='edit_puzzle.php' method='post'>\n";
						echo "\t<td>".$puzzleId."<input type='hidden' id='$puzzleId' name='puzzleId' value='".$puzzleId."' size='0';'/></a></td>\n";
						echo "\t<td>".$puzzleWord."</a><input type='hidden' id='$puzzleId' name='puzzleWord' value='".$puzzleWord."' size='0';'/></td>\n";
						echo "\t<td>";
						echo "<input type='image' src='edit.png' name='id' value='".$puzzleId."'  alt='submit' style='width: 22px;'>";
						
						echo "\t</form>";
						if(isset($_SESSION["isAdmin"])){
												if($_SESSION["isAdmin"] == 1){
						echo "<input onclick='deletePuzzle(this)' type='image' name='id' value='".$puzzleId."'src='delete.png' style='width: 22px;'>";
												}
						}
						
						
				echo "</tr>\n"; 
			}
				
		
	
		
    ?>
	 </tbody>

            <tfoot>

            <tr>

             <th>Puzzle ID</th>

                <th>Puzzle</th>
				
				

                <th>Actions</th>

            </tr>

            </tfoot>

        </table>

    </div>

</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">

		 $(document).ready(function() {

        $('#info').DataTable();

    });
		function deletePuzzle(puzzle) {
			//alert(puzzle.value);
			var r = confirm("Would like to delete " + puzzle.value + "?");
			if (r == true) {
				window.location="delete_puzzle.php?id=" + puzzle.value;
			} else {
				
			}
		}
		
		function playPuzzleLink(object) {
			
				window.location="puzzle.php?id=" + object + "&title=" + puzzle.name;
			
		}
		
		
		function playPuzzle(puzzle) {	
			
				window.location="puzzle.php?id=" + puzzle.value + "&title=" + puzzle.name;
			
		}
	</script>
	</body>
</html>