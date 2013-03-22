<html>
<head>
<title> Show payment </title>
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
}

</style>
<script src="http://d3js.org/d3.v3.min.js"></script>

</head>

<body>
<h1> User Payment </h1>



<?php


 
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

	  /* $dataFile = "out.html"; */
	  /* $stringData = "hello world"; */
	  /* file_put_contents($dataFile,$stringData); */


     /**************************************
    * Play with databases and tables      *
    **************************************/
  
    // Select all data from file db userpayment table 
    $result = $file_db->query('SELECT Upayment, count(*) FROM userpayment GROUP BY Upayment');

	

    /************************************************************/
    /* foreach($result as $row) {							    */
	/* 	// echo "user ID: " . $row['userID'] . "\n <br>";	    */
	/* 	echo "payment: " . $row['Upayment'] . "<br>\n";		    */
	/* 	echo "count: " . $row['count(*)'] . "<br>\n";		    */
	/* 	/\**************************************\/			    */
    /*     /\* echo "my array: ". "<br>";		  *\/		    */
	/* 	/\* foreach($row as $key => $val) {	  *\/			    */
	/* 	/\* 	print($key);					  *\/		    */
	/* 	/\* 	print_r($val);					  *\/		    */
	/* 	/\* }								  *\/			    */
    /*     /\**************************************\/		    */
	/* 	echo "\n";											    */
    /* }													    */
    /************************************************************/
 
 
    /**************************************
    * Close db connections                *
    **************************************/
 
    // Close file db connection
	  $file_db = null;

	  $label = 'letter';
	  $freq = 'frequency';
	  
	  echo "before new stuff";

	  $dataObject=array();

	  foreach($result as $row) {
		  
		  $newrow = $row;
		  $newrow[$label] = $row['Upayment'];
		  $newrow[$freq]  = $row['count(*)'];

		  $dataObject[] = $newrow;

		  echo "payment: " . $newrow['letter'] . "<br>";
		  echo "count: " . $newrow['frequency'] . "<br>";
	  }

	  echo json_encode($dataObject);

	  echo "end of php";
	  

  }
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
?>
<script>

var margin = {top: 20, right: 20, bottom: 30, left: 40},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

var formatPercent = d3.format(".0%");

var x = d3.scale.ordinal()
    .rangeRoundBands([0, width], .1, 1);

var y = d3.scale.linear()
    .range([height, 0]);

var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");

var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left")
    .tickFormat(formatPercent);

var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
	.append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

	//	d3.tsv("data.tsv", function(error, data) {
	//   	d3.tsv("generatePaymentDataToTsv.php", function(error, data) {
   	d3.tsv("other.tsv", function(error, data) {
			
		data.forEach(function(d) {
	    d.frequency = +d.frequency;
		});

	//	var dataset = <?php echo json_encode($dataObject); ?>;

		
  x.domain(data.map(function(d) { return d.letter; }));
  y.domain([0, d3.max(data, function(d) { return d.frequency; })]);

  svg.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + height + ")")
      .call(xAxis);

  svg.append("g")
      .attr("class", "y axis")
      .call(yAxis)
    .append("text")
      .attr("transform", "rotate(-90)")
      .attr("y", 6)
      .attr("dy", ".71em")
      .style("text-anchor", "end")
      .text("Frequency");

  svg.selectAll(".bar")
      .data(data)
    .enter().append("rect")
      .attr("class", "bar")
      .attr("x", function(d) { return x(d.letter); })
      .attr("width", x.rangeBand())
      .attr("y", function(d) { return y(d.frequency); })
      .attr("height", function(d) { return height - y(d.frequency); });

  d3.select("input").on("change", change);

  var sortTimeout = setTimeout(function() {
    d3.select("input").property("checked", true).each(change);
  }, 2000);

  function change() {
    clearTimeout(sortTimeout);

    // Copy-on-write since tweens are evaluated after a delay.
    var x0 = x.domain(data.sort(this.checked
        ? function(a, b) { return b.frequency - a.frequency; }
        : function(a, b) { return d3.ascending(a.letter, b.letter); })
        .map(function(d) { return d.letter; }))
        .copy();

    var transition = svg.transition().duration(750),
        delay = function(d, i) { return i * 50; };

    transition.selectAll(".bar")
        .delay(delay)
        .attr("x", function(d) { return x0(d.letter); });

    transition.select(".x.axis")
        .call(xAxis)
      .selectAll("g")
        .delay(delay);
  };
		
});

</script>
<label><input type="checkbox"> Sort values</label>


	<script>

	d3.tsv("data.tsv", function(error, data) {

	data.forEach(function(d) {
    d.frequency = +d.frequency;
	});


	var hello = data;

document.write(hello);

</script>





</body>
</html>