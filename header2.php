<?php
    session_start();
?>

   
	<div class="jumbotron" align="center" style="background-color:#64E464">
             
			<div style="text-align: center">
<a href="index.php"><img src='silcHeader.png' id='header'/></a>
</div>
			<H1 id='shout' style="font-size: 300%">Anagram Puzzler</H1>
			
			<div class='admin' style="background-color:yellow">
			<?php
				if(isset($_SESSION["isAdmin"])){
                    if($_SESSION["isAdmin"] == 1){
                        echo "<a class='links' href='logout.php'>Logout</a>";                        
                    }
				} else {
					echo "<a class='links' href='login.php'>Login</a>";
				}
			?>
			</div>

        <?php
			

		
		 //  if(isset($_SESSION["isAdmin"])){
                   // if($_SESSION["isAdmin"] == 1){
                  //      echo '<div class="admin" style="background-color:#6495ED">';
                 //       echo '<a class="links" align="center" href="addPuzzle.php">Add A Puzzle</a>';
                 //       echo '</div>';
                 //   }
          //  }
		?>
		
			<div class='admin' style="background-color:#089e9e">
				<a class='links' href="all_word_list.php">List</a>
			</div>
			
					  <?php
            
           // if(isset($_SESSION["isAdmin"])){
                   // if($_SESSION["isAdmin"] == 1){
                     //   echo '<div class="admin" style="background-color:#089e9e">';
                     //   echo '<a class="links" align="center" href="missing_children.php">Missing Children</a>';
                    //    echo '</div>';
                  //  }
         //   }
            ?>
			
			  <?php
            
            //if(isset($_SESSION["isAdmin"])){
                    //if($_SESSION["isAdmin"] == 1){
                     //   echo '<div class="admin" style="background-color:#089e9e">';
                    //    echo '<a class="links" align="center" href="anagram_list.php">Master List</a>';
                    //    echo '</div>';
                   // }
           // }
            ?>
			
		
			
			
            <?php
            
            if(isset($_SESSION["isAdmin"])){
                    if($_SESSION["isAdmin"] == 1){
                        echo '<div class="admin" style="background-color:#00fff6">';
                        echo '<a class="links" align="center" href="admin.php">Admin</a>';
                        echo '</div>';
                    }
            }
            ?>
			
			
			
			
            
		</div>
	
	
