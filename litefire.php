<html>
<head>
</head>
<body>
<?php

session_start();

echo "start";

$file = $_SERVER['DOCUMENT_root']."db/test.db";

echo $file;

$dbhandle = sqlite_open($file,0666,$error);

if (!$dbhandle) die ($error);

echo "not dead";

$query = "SELECT name, sex FROM Friends";

$result = sqlite_query($dbhandle,$query);
if(!$result) die("Cannot execute query.")';
echo "not dead 2";

// {
// 		echo "print data";
// 	echo $row['bar'] . "<br/>";
// }

// /*


// session_start();

// if($db = sqlite_open('tmp.db',0666,$sqliteerror)) {
// 	   echo "hello";
// 	   sqlite_query($db, 'CREATE TABLE foo (bar varchar(10))');
// 	   sqlite_query($db, "INSERT INTO foo VALUES ('fnord')");
// 	   $result = sqlite_query($db, 'select bar from foo');
// 	   var_dump(sqlite_fetch_array($result));
// } else {
//   echo "sqlerror";
// }

// sqlit_close($db)


// //set path of database file
// $db = $_SERVER['DOCUMENT_root']."/RCdata/rcdata.db";
// echo $db;

// //open database file
// $handle=sqlite_open($db) or die("Could not open database");
// echo $handle;

// $query = "SELECT smoker, count(*) FROM userprofiles GROUP BY smoker";
// echo $query;

// // execute query

// //$result = sqlite_query($handle,$query) or die("Error in query:".sqlite_error_string(sqlite_last_error($handle)));
// //echo $result;

// echo 'hello world';

// //sqlite_close($handle);

// echo 'hello world2';

?>
</body>
</html>