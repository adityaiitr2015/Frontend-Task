<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Expense Manager</title>
    </head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<style type="text/css">
		
		#visualization
		{
			width: 900px;
			height: 550px;
			margin-left:235px;
			margin-top:15px;
		}
		#pie
		{
			float:right;
			font:60%;  
		}
		#back
		{
			font:60%; 
			margin-left:650px;			
		}
		#date
		{
			
			font:60%;
			  
		}
	</style>
    
<body background="pic.jpg" style="font-family: Arial;border: 0 none;">
	<nav class="navbar navbar-light bg-light navbar-fixed-top justify-content-between">
		  <a class="navbar-brand" href="#">
			<img src="logo.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
			Expense Manager
		  </a>
		  <div class="form-inline">
			<a href='index.php'>
				<button class="btn btn-success my-2 my-sm-0" id="back" name="back" type="submit">
					Go Back
				</button>
			</a>
		  </div>
		  
		  <div class="form-inline">
			<a href='task.php'>
			    <button class="btn btn-success my-2 my-sm-0" value="saved data. type="submit">
				    View Pie Chart
			    </button>
			</a>
		  </div>
		  
		  <div class="form-inline">
			<a href='delete.php'>
			    <button class="btn btn-danger my-2 my-sm-0"id="pie" name="pie" value="Clear all the saved data. type="submit">
				    Clear saved data
			    </button>
			</a>
		  </div>
		  
	 </nav>
    <!-- where the chart will be rendered -->
	 <div id="visualization"></div>
    <?php
 
    //include database connection
    include 'db_connect.php';
 
    //query all records from the database
    $query = "select * from analyzer";
 
    //execute the query
    $result=mysqli_query($link,$query);
 
    //get number of rows returned
    $num_results=mysqli_fetch_array($result);
 
    if( $num_results > 0){
 
    ?>
        <html>
   <head>
      <title>Expense Manager</title>
      <script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js">
      </script>
      <script type = "text/javascript">
         google.charts.load('current', {packages: ['corechart']});     
      </script>
   </head>
   
   <body>
      <div id = "container" style = "width: 550px; height: 400px; margin: 0 auto">
      </div>
      <script language = "JavaScript">
         function drawChart() {
            // Define the chart to be drawn.
            var data = google.visualization.arrayToDataTable([
                    ['Reason', 'Amount','Date'],
                    <?php
                    while( $row = $result->fetch_assoc() ){
                        extract($row);
						$temp=0;
						for($i=0;$i<2;$i=$i+1)
						{
						   $temp=$temp*10+$date[$i];
						}
                        echo "['{$reason}', '{$amount}',  '{$temp}'],";
                    }
                    ?>
                ]);
 
            var options = {title: 'Date wise expense', isStacked:true};  

            // Instantiate and draw the chart.
            var chart = new google.visualization.BarChart(document.getElementById('container'));
            chart.draw(data, options);
         }
         google.charts.setOnLoadCallback(drawChart);
      </script>
   </body>
</html>
    <?php
 
    }else{
        echo "<div style='text-align:center;color:red;margin-top:-350px;'><h2>No data found in the database.</h2></div>";
    }
    ?>
    
</body>
</html>