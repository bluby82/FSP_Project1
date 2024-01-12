<?php  
	class koneksi
	{
		protected $con;

		public function __construct(){
			$this->con = new mysqli("localhost", "root", "", "fsp_project1_160721046");
		}

		public function __destruct(){
			$this->con->close();
		}
	}
?>