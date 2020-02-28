<?php

class DBContext
{
	private $servername = "";
	private $username = "";
	private $password = "";
	private $dbname = "";
	
	private __construct()
	{
		$this->connection=mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);

        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
	}
}

?>