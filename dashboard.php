<?php 
	session_start();
		
	if($_SESSION['search_result']=='')
	{
		header('location:index.php');
		exit;
	}
	

?>

<!DOCTYPE html>
<html>
<head>
<title>Search Result</title>
<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="container-dashboard">
		Search Value is <span class="result"><?php echo ucwords($_SESSION['search_result'])?>  </span> 
		<br>
		
		<a href="clearsearch.php?home=true" >Home Page</a>
	</div>
</body>
</html>