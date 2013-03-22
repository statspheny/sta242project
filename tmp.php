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
if(!$result) die("Cannot execute query.");
echo "not dead 2";

sqlite_close($dbhandle);

?>
</body>
</html>
