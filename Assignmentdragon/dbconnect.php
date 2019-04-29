<?PHP
	class dbconnect {
		
		private $servername = "localhost";
		private $username = "DragonUser";
		private $password = "ABC123qw";
		private $dbname = "dragonhouse";	
		
		
		// connection reference
		private $conn;
		
		// status
		public $err = "";
		
		// construct fn
		public function connect() {
			// Create connection
			$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
			
			// Check connection (handle better than this!!!)
			if ($this->conn->connect_error) {
				//die("Connection failed: " . $conn->connect_error);
				$this->err .= "<p class='err'>Connection failed: " . $conn->connect_error . "</p>";
				return false;
			}		
			return true;
		}
		
		// run update query and return boolean to indicate success of it
		public function update($sql) {
			if ($this->conn->query($this->killinj($sql)) === TRUE) {
				return true;
			}
			else {
				$this->err .= "<p class='err'>Failed to create record: " . $conn->error . "</p>";
				return false;
			}
		}

		// run select query and return the result object
		public function select($sql) {
			return $this->conn->query($this->killinj($sql));
		}

		// run drop query and return boolean to indicate success of it
		public function drop($sql) {
			if ($this->conn->query($this->killinj($sql)) === TRUE) {
				return true;
			}
			else {
				$this->err .= "<p clas='err'>Failed to destroy record: " . $conn->error . "</p>";
				return false;
			}
		}
		
		// close connection when done.
		public function close() {
			$this->conn->close();
		}
		
		// kill SQL injection by removing special characters from SQL strings 
		// this makes them non-executable in any way other than as intended by the script
		private function killinj($sql) {
			$pattern = "/[;:$]/";
			return preg_replace($pattern,"", $sql);
			
			// array and string_replace non-regexp version
			//$patterns = array(";", ":", "$");
			//return str_replace($patterns, "", $sql);
		}
	}
	error_reporting(E_ALL ^ E_NOTICE);
?>