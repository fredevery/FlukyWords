<?php 
	define("ROOT", $_SERVER["DOCUMENT_ROOT"] . "/");
	class fluky_db{
		
		private $server = "localhost";
		private $username = "headoffr_root";
		private $password = "j00j00b00";
		private $database = "headoffr_hof";
		private $db_conn, $selected_db;
		private $pics_array = array();
		
		public function __construct(){
			if(!$this->db_conn = mysql_connect($this->server, $this->username, $this->password)){
				die("Could not connect:".mysql_error());
			}else{
				$this->get_db();
			}
		}
		
		private function get_db(){
			if(!mysql_select_db($this->database,$this->db_conn)){
				die("Error getting DB: ".mysql_error());
			}
		}
		
		public function get_random_sentence(){
			$count = mysql_query("SELECT count(sentence) FROM sentences");
			$row = mysql_fetch_row($count);
			$rand = mt_rand(0,$row[0] - 1);
			$result = mysql_query("SELECT sentence FROM sentences LIMIT $rand, 1");
			$row = mysql_fetch_array($result);
			$sentence = $row['sentence'];
			
			if($sentence){
				return $sentence;
			}else{
				return mysql_error();
			}
		}
		
		public function save_new_sentence($sentence){
			$query = "INSERT INTO sentences (sentence) VALUES ('$sentence')";
			if(!$result = mysql_query($query)){
				return "Error: ".mysql_error();
			}else{
				return "Sentence Saved";
			}
		}
		
		public function get_all_sentences(){
			$query = "SELECT sentence FROM sentences LIMIT 100";
			if(!$result = mysql_query($query)){
				return "Error: ".mysql_error();
			}else{
				$returnArray = "";
				while($row = mysql_fetch_assoc($result)){
					$returnArray .= $row['sentence'].",";
				}
				return $returnArray;
			}
		}
		
		public function get_last_sentence(){
			$query = "SELECT sentence FROM sentences ORDER BY id DESC LIMIT 1";
			if(!$result = mysql_query($query)){
				return "Error: ".mysql_error();
			}else{
				$row = mysql_fetch_array($result);
				$sentence = $row['sentence'];
				return $sentence;
			}
		}
	}
?>