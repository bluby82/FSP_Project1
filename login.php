<?php  
	session_start();
	require_once('class/Users.php');

	if (isset($_GET['logout'])) {
		session_destroy();
		header("location: login.php");
	}

	if (isset($_POST['submit'])) {
		$object = new Users();

		$hasil = $object->logIn($_POST['user'], $_POST['pass']);

		if ($hasil !== "Password salah" && $hasil !== "User tidak ditemukan") {
			$_SESSION['userLogin'] = $hasil;
			header("location: home.php");
		}
		else{
			echo "<script>alert('$hasil');</script>";
			// echo $hasil.'<br><br>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/auth.css">
</head>
<body>
	<h1>Welcome !   </h1>
	<div id="container1">
		<form method="POST" action="login.php">
			User ID:<br><input class="textbox" type="text" name="user"><br>
			Password:<br><input class="textbox" type="password" name="pass"><br><br>
			<input class="button" type="submit" name="submit" value="Login">
		</form>
		<p>Daftar di <a href="registration.php">sini</a></p>
		<p class="additional">160721046 | 160421115 | 160421129</p>
	</div>
</body>
</html>