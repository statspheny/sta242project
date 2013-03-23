<html>
<head> 
<title> Get Our Data Counts </title> 
</head>

<body>

<h3>You chose table <?php echo htmlspecialchars($_POST['table']); ?></h3>
<h1> Choose a Column </h1>

<br>

<?php
$tblname = $_POST['table'];
try {
	// Open connection
	$file_db = new PDO('sqlite:rcdata.db');
	
	// Set errormode to exceptions
	$file_db->setAttribute(PDO::ATTR_ERRMODE, 
						   PDO::ERRMODE_EXCEPTION);

	// Get all the columns
	$tablecols = array_reduce($file_db->query("PRAGMA table_info(`$tblname`)")->fetchAll(),
							  function($rV,$cV) {
								  $rV[]=$cV['name']; 
								  return $rV;
							  },array());

	$results = $file_db->query("PRAGMA table_info(`$tblname`)");
	
	//echo json_encode($tablecols);
	
	echo '<form action="drawBars.php" method="post">'. "\n" ;
	echo "<select name=\"column\">\n";

	foreach($results as $row) {
		echo "<option val=".$row['name'].">" . $row['name'] . "</option> \n";
	}
	echo "</select>\n";

	echo $tblname;
	echo '<input type="hidden" name="table" value='. $tblname . " />\n";
	
	echo ' <p><input type="submit" /></p>'."\n";

	echo '</form>'."\n";

    // Close file db connection
    $file_db = null;

  }
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }

?>



</body>
</html>
