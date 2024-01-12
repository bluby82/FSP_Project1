<?php 
	require_once('class/Users.php');

	if (isset($_POST['submit'])) {

		$userId = htmlentities(strip_tags($_POST['user']));
		$nama = htmlentities(strip_tags($_POST['nama']));
		$pass = $_POST['pass'];

		$objectCek = new Users();
		$statusDuplikat = $objectCek->cekDuplikat($userId);


		if ($_POST['user'] === "" || $_POST['nama'] === "" || $_POST['pass'] === "") {
			$pesan = "Tolong isi data dengan benar terlebih dahulu!";
			echo "<script>alert('$pesan');</script>";
		}
		elseif ($statusDuplikat === "duplikat") {
			$pesan = "User ID tersebut telah digunakan. Coba daftar menggunakan User ID lain!";
			echo "<script>alert('$pesan');</script>";
		}
		elseif ($_POST['pass'] === $_POST['konfpass']){
			$object = new Users();
			$hasil = $object->registration($userId, $nama, $pass);

			if ($hasil === "Data berhasil disimpan") {
				echo "<script>alert('$hasil');</script>";
				// echo $hasil.'<br><br>';
			}
			else{
				echo "<script>alert('$hasil');</script>";
				// echo $hasil;
			}
		}
		else{
			echo "<script>alert('Password tidak sama');</script>";
			// echo "Password tidak sama";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pendaftaran</title>
	<link rel="stylesheet" type="text/css" href="css/auth.css">
</head>
<body>
	<h1>Registration   </h1>
	<div id="container2">
		<form method='POST' action='registration.php'>
			User ID:<br><input class="textbox" type="text" name="user"><br>
			Nama:<br><input class="textbox" type="text" name="nama"><br>
			Password:<br><input class="textbox" type="password" name="pass"><br>
			Ulangi password:<br><input class="textbox" type="password" name="konfpass"><br><br>
			<input class="button" type="submit" name="submit" value="Daftar">
		</form>
		<p>Kembali ke halaman <a href="login.php">login</a></p>
	</div>
</body>
</html>