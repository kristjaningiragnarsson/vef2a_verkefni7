<?php
	require 'conn.php';
	if(empty($_SESSION['name']))
		header('Location: login.php');

	if(isset($_POST['update'])) {
		$errMsg = '';

		// Getting data from FROM
		$nafn = $_POST['nafn'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		if($password != $password2)
			$errMsg = 'lykillorðinn eru ekki eins.';

		if($errMsg == '') {
			try {
		      $sql = "UPDATE users SET nafn = :nafn, password = :password, email = :email WHERE username = :username";
		      $stmt = $connect->prepare($sql);                                  
		      $stmt->execute(array(
		        ':nafn' => $nafn,
		        ':email' => $email,
		        ':password' => $password,
		        ':username' => $_SESSION['username']
		      ));
				header('Location: update.php?action=updated');
				exit;

			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'updated')
		$errMsg = '<a href="logout.php">skrá út</a> og skrá inn til að sjá ef það virkaði';
?>

<html>
<head>
<title>uppfæra</title>
</head>

<body>

			<?php
				if(isset($errMsg)){
					echo $errMsg
				}
				?>
		
				<form action="" method="post">
					Nafn <br>
					<input type="text" name="nafn" value="<?php echo $_SESSION['name']; ?>" autocomplete="off" class="box"/><br /><br />
					Username <br>
					<input type="text" name="username" value="<?php echo $_SESSION['username']; ?>" disabled autocomplete="off" class="box"/><br /><br />
					email <br>
					<input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" autocomplete="off" class="box"/><br /><br />
					<hr>
					lykillorð <br>
					<input type="password" name="password" value="<?php echo $_SESSION['password'] ?>" class="box" /><br/><br />
					staðfesta lykillorð <br>
					<input type="password" name="passwordVarify" value="<?php echo $_SESSION['password'] ?>" class="box" /><br/><br />
					<input type="submit" name='update' value="Update" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</body>
</html>
