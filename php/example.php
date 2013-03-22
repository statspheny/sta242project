<html>
<head> 
<title> My page </title> 
</head>

<body>
<?php echo '<p>hello world</p>'; ?>

<h1> Other Stuff </h1>
X
<form action="action.php" method="post">
 <p>Your name: <input type="text" name="name" /></p>
 <p>Your age: <input type="text" name="age" /></p>
 <p><input type="submit" /></p>
</form>


<?php
echo $_SERVER['HTTP_USER_AGENT'];
?>



</body>
</html>
