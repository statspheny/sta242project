<html>
<head>
<title> Show payment </title>
</head>

<body>
<h1> User Payment </h1>

<?php
 
// Set default timezone
date_default_timezone_set('UTC');
 
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
 
     /**************************************
    * Play with databases and tables      *
    **************************************/
  
    // Select all data from file db userpayment table 
    $result = $file_db->query('SELECT * FROM userpayment');

    foreach($result as $row) {
      echo "user ID: " . $row['userID'] . "\n";
      echo "payment: " . $row['Upayment'] . "\n";
      echo "\n";
    }
 
 
    /**************************************
    * Close db connections                *
    **************************************/
 
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