<?php

class DBContext
{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "";

	private $connection;

	private function __construct()
	{
		$this->connection=mysqli_connect($this->servername,$this->username,$this->password,$this->dbname);

        if ($this->connection->connect_error) {
            die("Database connection failed: " . $this->connection->connect_error);
        }
	}

	public function InsertUser($email, $firstname, $surname, $password)
    {
        $query = mysqli_prepare($this->connection, "CALL insert_User(?,?,?,?)");
        mysqli_stmt_bind_param($query, "ssss", $email, $firstname, $surname, $password);
        mysqli_stmt_execute($query);
    }

    public function GetUsers()
    {
        $query = mysqli_query($this->connection, "SELECT * FROM User")
        or die (mysqli_error($this->connection));

        $users = [];

        //Rows need to be retrieved this was to preserve the column names
        while ($row = mysqli_fetch_array($query))
            array_push($users, $row);

        return $users;
    }//This function returns spurious data and can be improved
}

?>