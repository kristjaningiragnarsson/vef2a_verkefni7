<?php
	require 'conn.php';

	if(isset($_POST['login'])) {
		$errMsg = '';

		// nær i upplysingar frá database
		$username = $_POST['username'];
		$password = $_POST['password'];
		$encrypt = crypt( $password );//encryptar password
		if($username == '')//ef það er ekki skrifað rétt kemur error
			$errMsg = 'Enter username';
		if($password == '')
			$errMsg = 'Enter password';

		if($errMsg == '') {
			try {
				$stmt = $connect->prepare('SELECT id, nafn, username, password, email FROM users WHERE username = :username');//nær i allt data frá database þar sem username er
				$stmt->execute(array(
					':username' => $username
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				if($data == false){
					$errMsg = "Notandi $username er ekki til.";
				}
				else {//hérna skýrir hann hvað dataið frá databasinum í session
					if($password == $data['password']) {
						$_SESSION['name'] = $data['nafn'];
						$_SESSION['username'] = $data['username'];
						$_SESSION['password'] = $data['password'];
						$_SESSION['email'] = $data['email'];

						header('Location: admin.php');//sendir þig til admin siðuna
						exit;
					}
					else
						$errMsg = 'Password not match.';
				}
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}
?>

<html>
<head>
<title>skrá inn</title>
</head>
	
			<body>
					<?php
				if(isset($errMsg)){
					echo $errMsg
				}
			?>
				<form action="" method="post"> <!--hérna nær hann í username og password og sendir það up til if(isset($_POST['login'])) efst á siðuni -->
					<p>username</p><input type="text" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="off" class="box"/><br /><br />
					<p>password</p><input type="password" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" autocomplete="off" class="box" /><br/><br />
					<input type="submit" name='login' value="Login" class='submit'/><br />
				</form>
		</body>
</html>
