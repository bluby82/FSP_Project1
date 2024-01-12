<?php  
	session_start();
	require_once('class/Koneksi.php');
	require_once('class/Cerita.php');

	if (!isset($_SESSION['userLogin'])) {
		header("location: login.php");
	}

	if (isset($_POST['submit'])) {
		if ($_POST['judul'] === "") {
			$pesan = "Cerita gagal ditambahkan. Berikan sebuah judul untuk ceritamu!";
			echo "<script>alert('$pesan');</script>";
		}
		elseif ($_POST['paragraf'] === "") {
			$pesan = "Cerita gagal ditambahkan. Berikan sebuah paragraf untuk memulai ceritamu!";
			echo "<script>alert('$pesan');</script>";
		}
		else {
			$judul = $_POST['judul'];
			$userId = $_SESSION['userLogin'];
			$isi = $_POST['paragraf'];

			$object = new Cerita();
			$hasil = $object->buatCerita($judul, $userId, $isi);

			echo "<script>alert('$hasil');</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Buat Cerita</title>
	<link rel="stylesheet" type="text/css" href="css/story.css">
</head>
<body>
	<h1>Buat Cerita   </h1>
	<div id="container1">
		<form method="POST" action="buat.php">
			Judul<br><input class="textbox-1" type="text" name="judul"><br>
			Paragraf 1<br><textarea class="textbox-2" placeholder="Tulis paragraf di sini" name="paragraf"></textarea><br>
			<input class="button" type="submit" name="submit" value="Simpan">
		</form>
		<p>Kembali ke <a href="home.php">halaman utama</a></p>
	</div>
</body>
</html>