<html>
<head> 
<title> Get Our Data Counts </title> 
</head>

<body>

<h1> Choose a Table </h1>

<?php

try {
	// Open connection
	$file_db = new PDO('sqlite:rcdata.db');
	
	// Set errormode to exceptions
	$file_db->setAttribute(PDO::ATTR_ERRMODE, 
						   PDO::ERRMODE_EXCEPTION);
	
	// Get all the tables
	$result = $file_db->query('SELECT tbl_name FROM sqlite_master;');

	echo '<form action="getColumn.php" method="post">'. "\n" ;
	echo '<select name="table">'."\n";

	foreach($result as $row) {
		echo "<option val=".$row[0].">" . $row[0] . "</option> \n";
	}

	echo "</select>\n";
	
	echo ' <p><input type="submit" /></p>'."\n";

	echo '</form>'."\n";

	echo $_SERVER['HTTP_USER_AGENT'];
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
