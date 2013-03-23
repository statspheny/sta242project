<html>
<head>
<title> Show Plots </title>
<meta charset="utf-8">
<style>
body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  position: relative;
  width: 960px;
}

.axis text {
  font: 10px sans-serif;
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.bar {
  fill: steelblue;
  fill-opacity: .9;
}

.x.axis path {
  display: none;
}

label {
  position: absolute;
  right: 10px;
</style>

<script src="http://d3js.org/d3.v3.min.js"></script>

</head>

<body>

<?php
	  
	  $tablename = $_POST['table'];
	  $columnname = $_POST['column'];

	  echo "<h1>" . $tablename . ":" . $columnname . "</h1>";
		  


 
// Set default timezone
  try {
	  /**************************************
	   * Create databases and                *
	   * open connections                    *
	   **************************************/
 
	  // Create (connect to) SQLite database in file
	  $file_db = new PDO('sqlite:rcdata.db');
	  // Set errormode to exceptions
	  $file_db->setAttribute(PDO::ATTR_ERRMODE, 
							 PDO::ERRMODE_EXCEPTION);


    $result = $file_db->query("SELECT `$columnname`, count(*) FROM `$tablename` GROUP BY `$columnname`"); 

    // Close file db connection
	  $file_db = null;

	  echo "<h2>List of Values </h2>";
	  foreach($result as $row) {
		  
		  $newrow = $row;
		  echo $row[0] . " " . $row[1] ."<br>";
		  $counts[] = $row[1];
		  $dataObject[] = $newrow;
	  } 

	  $maxcounts = max($counts);

	  // echo json_encode($dataObject);

	  // echo "end of php";
	  

  }
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
?>

<script>

var results = <?php echo json_encode($dataObject); ?>;

var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var barPadding = 10;

if(results.length>60) {
	barPadding = 0;
}

var svg = d3.select("body").append("svg");

var xScale = d3.scale.linear()
	.domain([0,results.length])
	.range([0,width]);

var maxy = <?php echo $maxcounts; ?>;

var yScale = d3.scale.linear()
	.domain([0,maxy])
	.range([0,height]);

   svg.selectAll("rect")
	.data(results)
	.enter()
	.append("rect")
	.attr("x",function(d,i) {  return i*width/results.length; })
	.attr("width",width/results.length - barPadding)
	.attr("height", function(d) { return yScale(d[1]); })
	.attr("fill","indigo")
	.attr("y",function(d) {  return height-yScale(d[1]); });

svg.selectAll("text")
	.data(results)
	.enter()
	.append("svg:text")
	.attr("x", function(d, i) { return i*width/results.length; })
	.attr("y", function(d) { return height - yScale(d[1])+20; })
	.text(function(d) { return d[1];})
	.attr("fill", "red");
 

   svg.selectAll("p")
	   .data(results)
	   .enter()
	   .append("text")
	   .text(function(d) {return d[0]; })
	   .attr("x", function(d,i) { return i*(width/results.length); })
	   .attr("y", height+20);


</script>





</body>
</html>