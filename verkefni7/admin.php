<?php//admin siðan
	require 'conn.php';
	if(empty($_SESSION['name']))//hérna nær hann i name fra login siðunni
		header('Location: login.php');
?>

<html>
<head>
<title>admin</title>
</head>
<body>
		velkominn <?php echo $_SESSION['name']; ?> <br> <!-- hérna kemur nafn af notanda og svo linkar-->
		<a href="update.php">uppfæra</a> <br>
		<a href="remove.php">eyða mynd<br>
		<a href="logout.php">skrá út</a>
</body>
</html>
