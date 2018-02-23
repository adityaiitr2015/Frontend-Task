<?php
    $link=mysqli_connect("localhost", "root", "", "task");
	
	if(mysqli_connect_error())
	{
		echo "Error in connection";
	}
	
	$query="INSERT INTO analyzer (reason, amount) VALUES('X','10000')";
	
	mysqli_query($link,$query);
?>