<?php
class Database {
	protected $_link;
	protected $_result;
	protected $_numRows;
	private $_host = "HOST";
	private $_username = "DATABASE USERNAME";
	private $_password = "DATABASE PASSWORD";
	private $_database = "DATABASE";

	// Establece conexión a DB cuando la clase es instanciada
	public function __construct() {
		$this->_link = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);

		if(mysqli_connect_errno()) {
			echo "Connection Failed: " . mysqli_connect_errno();
			exit();
		}
	}

	// Envío de query a la conexión
	public function Query($sql) {
		$this->_result = $this->_link->query($sql) or die(mysqli_error($this->_result));
		$this->_numRows = mysqli_num_rows($this->_result);
	}

	// INSERT
	public function UpdateDb($sql) {
		$this->_result = $this->_link->query($sql) or die(mysqli_error($this->_result));
		return $this->_result;
	}

	// ROWS
	public function NumRows() {
		return $this->_numRows;
	}

	// FETCH
	public function Rows() {
		$rows = array();

		for($x = 0; $x < $this->NumRows(); $x++) {
			$rows[] = mysqli_fetch_assoc($this->_result);
		}
		return $rows;
	}

	//GETTER LINK
	public function GetLink() {
		return $this->_link;
	}

	// SEGURIDAD DE DATOS
	public function SecureInput($value) {
		return mysqli_real_escape_string($this->_link, $value);
	}
}
?>