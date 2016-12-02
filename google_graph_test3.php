<?php
	//$con = mysqli_connect('oniddb.cws.oregonstate.edu','kurakuls-db','LhvpurDSfTIDH2AR','kurakuls-db');
		//Turn on error reporting
	ini_set('display_errors', 'On');
		//Connects to the database
	$mysqli = new mysqli('oniddb.cws.oregonstate.edu','kurakuls-db','LhvpurDSfTIDH2AR','kurakuls-db');
	if($mysqli->connect_errno){
		printf("Connect failed: %s\n", mysqli_connect_error());
		 exit();
		}
		
	$result = $mysqli->query('SELECT YEAR(award_record.award_create_date) AS award_year, COUNT(award_record.award_record_ID ) AS award_count FROM award_record GROUP BY YEAR(award_record.award_create_date)');
	//$result = (string)$row['user'];
	//var_dump($result); 
	
	$rows = array();
	$table = array();
	$table['cols'] = array(
		array('label' => 'Year', 'type' => 'string'),
		array('label' => 'Number of Awards Given', 'type' => 'number')
	);
	
	foreach($result as $row) {
		$temp = array();
			// The following line will be used to slice the Pie chart
		$temp[] = array('v' => (string) $row['award_year']); 
			// Values of the each slice
		$temp[] = array('v' => (int) $row['award_count']); 
      $rows[] = array('c' => $temp);
    }

	$result->free();
	$table['rows'] = $rows;

		// convert data into JSON format
	$jsonTable = json_encode($table, true);
	//echo $jsonTable;
	
	//echo '<pre>';
	//echo json_encode($table, JSON_PRETTY_PRINT);
	//echo '</pre>';
?>

<!DOCTYPE html>
<html>
	<head>
		<!--<title>Business Intelligence Report</title>-->
			<!--Load jQuery-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
			<!--Load the Google JS API-->
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
			// Load the Visualization API and the piechart package.
		google.charts.load('current', {packages: ['corechart']});
			// Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);
 
			// Callback that creates and populates a data table,
			// instantiates the pie chart, passes in the data and
			// draws it.
      function drawChart() {
			// Create the data table
		var data = new google.visualization.DataTable(<?=$jsonTable?>);
	
		<!--var jsonData = $.ajax({url: "getData.php",dataType:"json",async: false}).responseText;
		-->
                   
			// Create the data table out of JSON data loaded from server.
		//var data = new google.visualization.DataTable(jsonData);
               
			// Set chart options
		var options = {
			title: 'Awards Given by Year',
			is3D: 'true'
		};
 
        // Instantiate and draw our chart, passing in some options.
		var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		chart.draw(data, options);
      }
		</script>
	</head>
 
	<body>
		<!--Div that will hold the pie chart-->
		<div id="piechart" style="width: 1200px; height: 800px;"></div>
	</body>
</html>