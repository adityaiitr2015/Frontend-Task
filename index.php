<!DOCTYPE html>
<?php

    $error = ""; 
	if (array_key_exists("submit", $_POST))
	{
        $link = mysqli_connect("localhost", "root", "", "task");
		
		if (mysqli_connect_error()) 
		{
            die ("Database Connection Error");
        }
		
		if (!$_POST['name']) 
		{
            $error .= "The reason for mony being spent is required.<br>";
        } 
        
        if (!$_POST['amount'])
		{
            $error .= "Amount is required. Please enter the amount.<br>";
        }
		
		if (!$_POST['date'])
		{
            $error .= "Date is required. Please enter the date.<br>";
        }
		//echo $_POST['name'];
	    $query = "SELECT amount FROM `analyzer` WHERE reason = '".mysqli_real_escape_string($link, $_POST['name'])."' LIMIT 1";

        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0 && $error=="" ) 
		{
			$row=mysqli_fetch_array($result);
			$newamount=$row['amount']+$_POST['amount'];
            $query="UPDATE `analyzer` SET amount='".mysqli_real_escape_string($link, $newamount)."' WHERE reason = '".mysqli_real_escape_string($link, $_POST['name'])."' LIMIT 1";
			mysqli_query($link,$query);
        } 
     	if ( mysqli_num_rows($result) <= 0 && $_POST['amount']!=0) 
		{
			$query="INSERT INTO `analyzer` (`reason`, `amount`,`date`) VALUES ('".mysqli_real_escape_string($link, $_POST['name'])."', '".mysqli_real_escape_string($link, $_POST['amount'])."', '".mysqli_real_escape_string($link, $_POST['date'])."')";
		    mysqli_query($link,$query);
		}
	}
?>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Expense Manager</title>
	
	<style type="text/css">
	      
	     .container
		 {
			 text-align:center; 
			 width:500px;
			 margin-top:140px;
		 }
		 #error
		 {
			 width:400px;
			 height:80px;
			 margin:0 auto;
			 font-size:80%;
			 margin-top:10px;
			 margin-bottom:10px;
		 }
		 #android
		{
		   
		   width:150px;
		   float:left;
		   margin-left:415px;
		   border-radius:3px;
		   height:46px;
		}
		#windows
		{
		   width:150px;
		   margin-top:-15px;
		   height:45px;
		   float:left;
		   margin-left: 30px;
		   border-radius:3px;
		}
		#iphone
		{ 
		   width:150px;
		   height:45px;
		   float:left;
		   margin-top:-31px;
		   margin-left: 30px;
		   border-radius:3px;
		}
		#download
		{
		   margin-top:105px; 
		   height:200px;
		   margin-bottom:2px;
		   
		}
		#text
		{
		    margin-top:20px;
		    font-size:130%;
			text-align:center;
			color:black;
		}
		
	</style>
  </head>
  
  <body background="bg.jpg">
      
    <div class="container" id="add">
		<h1 style="font:white;">Expense Manager</h1>
		<p style="font:white; margin-bottom:50px;"> <strong> A cool way to store & anaylze your expenses.</strong></p>
		
		<?php 
			if($error!="")
		    {
        		echo '<div class="alert alert-danger" role="alert" id="error">'.$error.'</div>';
    		}
		?>
		
		<form method="post" id="addup">
		
            <div class="form-group">
			    <input type="name" class="form-control" name="name" placeholder="Money spent for:">
			</div>
			
			<div class="form-group">
			    <input type="amount" class="form-control" name="amount" placeholder="Amount">
			</div>
		    
			<div class="form-group">
			    <input type="date" class="form-control" name="date" placeholder="Date">
			</div>
			
			<input type="submit" class="btn btn-success" name="submit" value="Add this to Expense Manager">
			<input type="submit" class="btn btn-warning" onclick="task.php" id="pie" name="show" value="Show the analysed data.">
             <?php
			     if(isset($_POST['show'])) 
					{ 
						header("Location: task.php"); 
					} 
              ?>
		</form>
	</div>
	
	<div id="download"> 
	    <p id="text"><strong> Download the Application from: </strong></p>
	    <a class="nav-link" href="https://play.google.com/store/apps?hl=en"><img id="android" src="android.jpeg"></a>
				
		<a class="nav-link" href="https://www.microsoft.com/en-IN/store/apps"><img id="windows" src="windows.jpeg"></a>
				
		<a class="nav-link" href="https://www.apple.com/in/ios/app-store/"><img id="iphone" src="iphone.jpeg"></a>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
  </body>
</html>