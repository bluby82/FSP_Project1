<?php  
	session_start();
	require_once('class/Users.php');
	require_once('class/Cerita.php');

	if (!isset($_SESSION['userLogin'])) {
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
	<div id="container">
		<?php  
			// untuk search
			$key = "";
			if(isset($_GET['key'])){
				$key = $_GET['key'];
				$search = "%".$_GET['key']."%";
			}
			else{
				$search = "%";
			}

			// mencari jumlah total
			$object = new Cerita();
			$perpage = 3;
			$totaldata = $object->getJumlahCerita($key);
			$totalpage = ceil($totaldata / $perpage);

			// mengambil data per page
			$p = 1;
			if(isset($_GET['p'])){
				$p = $_GET['p'];
			}
			else{
				$p = 1;
			}

			$start = ($p-1)*$perpage;

			$object = new Cerita();
			$hasil = $object->getCerita($key, $start, $perpage);


			if ($hasil) {
				// keyword
				echo '<form method="GET" action="home.php">';
				echo '<div class="normal-text">Cari Judul Cerita<br><input class="textbox" type="text" name="key" value="'.$key.'"></div>';
				echo '<input class="button-2" type="submit" name="submit" value="Cari">';
				echo '</form>';

				// tombol buat cerita
				echo '<form method="POST" action="buat.php">';
				echo '<input class="button-1" type="submit" name="buat" value="Buat Cerita Baru">';
				echo '</form><br>';

				// tabel
				echo '<table class="table">';
				echo '<tr class="table-title">';
				echo '<th>Judul</th>';
				echo '<th>Pembuat Awal</th>';
				echo '<th>Aksi</th>';
				echo '</tr>';

				while($row = $hasil->fetch_assoc()){
					echo '<tr class="table-text">';
					echo "<td>".$row['judul']."</td>";
					echo "<td>".$row['nama']."</td>";
					echo "<td>"."<a href='lihat.php?cerita=".$row['idcerita']."'>Lihat Cerita"."</td>";
					echo '</tr>';
				}
				echo '</table>';

				// navigation page
				echo '<ul>';
				for($i=1; $i<=$totalpage; $i++)
				{
					echo '<li><a href="home.php?p='.$i.'&key='.$key.'">'.$i.'</a></li>';
				}
				echo '</ul>';
			}
			else {
				echo "Cerita tidak ditemukan<br><a href='home.php'>Kembali</a>";
			}
		?>
		<form method="POST" action="login.php">
			<input type="hidden" name="logout" value="1">
			<button class="button-2" type="submit">Log out</button>
		</form>
	</div>
</body>
</html>