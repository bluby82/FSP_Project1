<?php  
	require_once('Paragraf.php');
	class Cerita extends koneksi
	{
		public function __construct(){
			parent::__construct();
		}	

		public function getCeritaById($idCerita){
			$sql = "SELECT * FROM cerita WHERE idcerita = ?";
			$stmt = $this->con->prepare($sql);
			$stmt->bind_param("i", $idCerita);
			$stmt->execute();
			$result = $stmt->get_result();

			if($row = $result->fetch_assoc()){
				return $row;
			}
			else {
				return false;
			}
		}

		public function getCerita($search, $start, $perpage){
			$sql = "SELECT * FROM cerita c INNER JOIN users u ON u.idusers = c.idusers_pembuat_awal WHERE c.judul LIKE ? LIMIT ?,?";
			$stmt = $this->con->prepare($sql);
			$search = "%".$search."%";
			$stmt->bind_param("sii", $search, $start, $perpage);
			$stmt->execute();
			$result = $stmt->get_result();

			if($result){
				return $result;
			}
			else {
				return false;
			}
		}

		public function getJumlahCerita($search){
			$sql = "SELECT COUNT(*) FROM cerita WHERE judul LIKE ?";
			$stmt = $this->con->prepare($sql);
			$search = "%".$search."%";
			$stmt->bind_param("s", $search);
			$stmt->execute();
			$result = $stmt->get_result();

			if($row = $result->fetch_assoc()){
				return $row['COUNT(*)'];
			}
			else {
				return false;
			}
		}

		public function buatCerita($judul, $user, $paragrafPertama){
			$status = "";

			$sql = "INSERT INTO cerita (judul, idusers_pembuat_awal) VALUES (?,?)";
			$stmt = $this->con->prepare($sql);
			$stmt->bind_param("ss", $judul, $user);
			$stmt->execute();

			$idCerita = $stmt->insert_id;

			$object = new Paragraf();
			$hasil = $object->buatParagraf($user, $idCerita, $paragrafPertama);

			if(!$stmt->error){
				$status = "Cerita berhasil ditambahkan";
			}
			else{
				$status = "Cerita gagal ditambahkan";
			}

			return $status;
		}
	}
?>