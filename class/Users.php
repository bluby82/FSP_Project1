<?php  
	require_once('Koneksi.php');

	class Users extends koneksi
	{
		public function __construct(){
			parent::__construct();
		}	

		public function logIn($user, $pass){
			$sql = "SELECT * FROM users WHERE idusers = ?";
			$stmt = $this->con->prepare($sql);
			$stmt->bind_param("s", $user);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($row = $result->fetch_assoc()) {
				$salt = $row['salt'];

				$md5pass = md5($pass);
				$combinedpass = $md5pass.$salt;
				$finalpass = md5($combinedpass);

				if ($finalpass === $row['password']) {
					return $user;
				}
				else{
					return "Password salah";
				}
			}
			else{
				return "User tidak ditemukan";
			}
		}

		public function registration($userId, $nama, $pass){
			$salt = str_shuffle("s160721046");

			$md5pass = md5($pass);
			$combinedpass = $md5pass.$salt;
			$finalpass = md5($combinedpass);

			$sql = "INSERT INTO users VALUES (?, ?, ?, ?)";
			$stmt = $this->con->prepare($sql);
			$stmt->bind_param("ssss", $userId, $nama, $finalpass, $salt);
			$stmt->execute();

			if(!$stmt->error){
				return "Data berhasil disimpan";
			}
			else{
				return "Data gagal disimpan";
			}
		}

		public function cekDuplikat($userId){
			$sql = "SELECT * FROM users WHERE idusers = ?";
			$stmt = $this->con->prepare($sql);
			$stmt->bind_param("s", $userId);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($row = $result->fetch_assoc()) {
				return "duplikat";
			}
			else{
				return "aman";
			}
		}
	}
?>