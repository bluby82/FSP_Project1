<?php  
	class Paragraf extends koneksi
	{
		public function __construct(){
			parent::__construct();
		}	

		public function getParagraf($idCerita){
			$sql = "SELECT * FROM paragraf p INNER JOIN cerita c ON c.idcerita = p.idcerita WHERE c.idcerita = ?";
			$stmt = $this->con->prepare($sql);
			$stmt->bind_param("s", $idCerita);
			$stmt->execute();
			$result = $stmt->get_result();

			if($result){
				return $result;
			}
			else {
				return false;
			}
		}

		public function buatParagraf($user, $cerita, $isi){
			$sql = "INSERT INTO paragraf (idusers, idcerita, isi_paragraf) VALUES (?,?,?)";
			$stmt = $this->con->prepare($sql);
			$stmt->bind_param("sis", $user, $cerita, $isi);
			$stmt->execute();

			if(!$stmt->error){
				return "Paragraf berhasil ditambahkan";
			}
			else{
				return "Paragraf gagal ditambahkan";
			}
		}
	}
?>