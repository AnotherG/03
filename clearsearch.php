<?php 

if(isset($_GET['home']))
{
	session_start() ;
	session_destroy() ;
	header('location:index.php');
	exit;
}
?>