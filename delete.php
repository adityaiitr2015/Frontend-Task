<?php
    //include database connection
    include 'db_connect.php';	
	
	$query="DELETE FROM `analyzer` WHERE id!=1";
	mysqli_query($link,$query);
	
	header("Location: index.php"); 
?>