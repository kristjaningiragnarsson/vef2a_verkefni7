<?php
	require 'conn.php';

	if(isset($_POST['register'])) {
		$errMsg = '';

		// Get data from FROM
		$nafn = $_POST['nafn'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];

		if($nafn == '')
			$errMsg = 'setja inn nafn';
		if($username == '')
			$errMsg = 'setja inn usernafn';
		if($password == '')
			$errMsg = 'setja inn password';
		if($email == '')
			$errMsg = 'setja inn email';

		if($errMsg == ''){
			try {
				$stmt = $connect->prepare('INSERT INTO users (nafn, username, password, email) VALUES (:nafn, :username, :password, :email)');
				$stmt->execute(array(
					':nafn' => $nafn,
					':username' => $username,
					':password' => $password,
					':email' => $email
					));
				header('Location: register.php?action=joined');
				exit;
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}

	if(isset($_GET['action']) && $_GET['action'] == 'joined') {
		$errMsg = 'innskráning er rétt nú geturu skráð þig inn<a href="login.php">skrá inn</a>';
	}
?>

<html>
<head>
<title>skráning</title>
</head>

<body>
				<?php
				if(isset($errMsg)){
					echo $errMsg
				}
			?>
			
				<form action="" method="post">
					<p>nafn</p><input type="text" name="nafn" placeholder="nafn" value="<?php if(isset($_POST['nafn'])) echo $_POST['nafn'] ?>" autocomplete="off" class="box"/><br /><br />
					<p>username</p><input type="text" name="username" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'] ?>" autocomplete="off" class="box"/><br /><br />
					<p>password</p><input type="password" name="password" placeholder="Password" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>" class="box" /><br/><br />
					<p>email</p><input type="text" name="email" placeholder="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" autocomplete="off" class="box"/><br /><br />
					<input type="submit" name='register' value="Register" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</body>
</html>
