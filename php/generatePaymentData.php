<html>
<head>
<title> Show payment </title>
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

	  $dataFile = "out.html";
	  $stringData = "hello world";
	  file_put_contents($dataFile,$stringData);


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

  }
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
?>

<a href="out.html">Click Here</a>

</body>
</html>