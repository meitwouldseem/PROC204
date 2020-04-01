<?php

class DBContext
{
	private $servername = "proj-mysql.uopnet.plymouth.ac.uk";
	private $username = "PRCO204_Y";
	private $password = "auCw5WTCsg4L66ce";
	private $dbname = "prco204_y";

	private $connection;

	public function __construct()
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

    public function InsertSleepDatum($SleepiD, $UserID, $SleepStart, $SleepEnd, $SleepMood)
    {
        $query = mysqli_prepare($this->connection, "CALL insert_Sleep(?,?,?,?,?)");
        mysqli_stmt_bind_param($query, "iissi", $SleepiD, $UserID, $SleepStart, $SleepEnd, $SleepMood);
        mysqli_stmt_execute($query);
    }//Call procedure name in this function is speculative pending implementation of said procedure

    public function GetSleepData()
    {
        $query = mysqli_query($this->connection, "SELECT * FROM SleepInstance")
        or die (mysqli_error($this->connection));

        $sleeps = [];

        //Rows need to be retrieved this was to preserve the column names
        while ($row = mysqli_fetch_array($query))
            array_push($sleeps, $row);

        return $sleeps;
    }//This function returns spurious data and can be improved

    public function GetSleepRange($Start, $End, $InputUserID)
    {
        $query = mysqli_prepare($this->connection, "CALL get_Sleep_Range(?,?,?)");
        mysqli_stmt_bind_param($query, "ssi", $Start, $End, $InputUserID);

        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        $data = mysqli_fetch_all($result, MYSQLI_NUM);

        $output = array(array(), array());

        foreach ($data as $value)
        {
            array_push($output[0], $value[0]);#labels
            array_push($output[1], intval($value[2]));#values
        }
        return $output;
    }
}

?>