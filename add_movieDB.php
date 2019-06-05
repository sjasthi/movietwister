
<?php
    include 'db_configuration2.php';    
	include 'word_processor.php';
	
	function is_anagram($a, $b)
 {	
       if (count_chars($a, 1) == count_chars($b, 1))
    {
        return true;
    }
    else
    {
		$error='The word '.$b.' is not an anagram of '.$a.'';
	echo "<script type='text/javascript'>alert('{$error}');</script>";

		
        return false;
    }
 }



		$obj= htmlspecialchars($_POST['anagrams']);
		$id=htmlspecialchars($_POST['parent']);
		$master=htmlspecialchars($_POST['masterWord']);
	
		 
		 
$arr=explode(PHP_EOL,$obj);

		$counter=(count($arr));
	
		
	$positions = "";
	$synonyms = "";
	$result = mysqli_query($db, "SELECT * FROM `movies_anagram` ORDER BY `anagram_id`");
 while ($row = mysqli_fetch_assoc($result)) {
        $max = $row['anagram_id'];             
            }
        mysqli_free_result($result);


	$parent = mysqli_query($db, "SELECT * FROM `movies_anagram` ORDER BY `movie_id`");
 while ($row = mysqli_fetch_assoc($parent)) {
        $max = $row['movie_id'];             
            }
        mysqli_free_result($parent);

		//print_r($obj);
		//echo $obj->synonyms;
	
	//echo $synonyms;
	//echo $positions;
       
		
			$deleteQuery = ("DELETE from `movies_anagram` where (movie_id = '') AND (anagram_id = '') ");
					
	$deleteStmt = $db->prepare($deleteQuery);
    $deleteStmt->execute();
    $deleteStmt->store_result();
	$deleteStmt->free_result();
	
	
	
		for ($i=0;$i<$counter;$i++){
			$size=strlen($arr[$i]);
			
		 if(is_anagram($master, $arr[$i])==true){
	
			if($arr[$i]!=""){
    $wordQuery = "INSERT INTO `movies_anagram` (`anagram_id`, `anagram`, `movie_id`) VALUES
					($max+($i+1), '$arr[$i]', $id)";
					//echo $wordQuery;
    $wordStmt = $db->prepare($wordQuery);
    $wordStmt->execute();
    $wordStmt->store_result();
	$wordStmt->free_result();
	
	}
	
		}
		
		}
               
		
	$db->close();
	 echo '<script>window.location.href = "movie_anagram_list.php";</script>';
?>

    