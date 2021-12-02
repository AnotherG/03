<?php 
	session_start();
	
	function isHTML($text){
		$processed = htmlentities($text);
		if($processed == $text) return false;
		return true; 
	 }

	if(isset($_POST['submit']))
	{
		if(isset($_POST['search']) !='')
		{
			$search = trim($_POST['search']);
			
			if(isHTML($search )==false){
				$errorMsg =  $search;
				$_SESSION['search_result'] =$search; 
				header('location:dashboard.php');
				#exit;
			}	
			
			else{
				$errorMsg =  "XSS Detected";
			}
		
		}
	}

	// else
	// 		{
	// 			$errorMsg =  "No User Found";
	// 		}
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="style.css">
</head>

<body>
	
	<div class="container">
		<h1>Search Bar</h1>
		<?php 
			if(isset($errorMsg))
			{
				echo "<div class='error-msg'>";
				echo $errorMsg;
				echo "</div>";
				unset($errorMsg);
			}
			
			// if(isset($_GET['logout']))
			// {
			// 	echo "<div class='success-msg'>";
			// 	echo "You have successfully logout";
			// 	echo "</div>";
				
			// }
			
			
			
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
			<div class="field-container">
				<label>Search:</label>
				<input type="text" name="search" required placeholder="Enter Your Search">
			</div>
			<div class="field-container">
				<button type="submit" name="submit">Search</button>
			</div>
			
		</form>
	</div>
</body>
</html>