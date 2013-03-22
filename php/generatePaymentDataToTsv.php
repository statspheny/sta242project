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
	$total = $file_db->query('SELECT count(*) FROM userpayment');

	$total2 = $total->fetch(PDO::FETCH_ASSOC);
	$sum = $total2['count(*)'];
	

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
	  
	  echo "Letter"."\t"."Frequency"."\n";

	  $dataObject=array();

	  /* $sum=0; */
	  /* foreach($result as $row) { */
	  /* 	  echo $sum; */
	  /* 	  echo $row['count(*)']; */
	  /* 	  $sum=$sum+$row['count(*)']; */
	  /* 	  echo $sum; */
	  /* } */

	  foreach($result as $row) {
		  
		  $freq = $row['count(*)']/$sum;
		  echo $row['Upayment'] . "\t". $freq ."\n";
	  }

  }
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
?>
