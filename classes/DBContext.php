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

    public function InsertSleepDatum($UserID, $SleepStart, $SleepEnd, $SleepMood)
    {
        $query = mysqli_prepare($this->connection, "CALL insert_Sleep(?,?,?,?)");
        mysqli_stmt_bind_param($query, "issi", $UserID, $SleepStart, $SleepEnd, $SleepMood);
        mysqli_stmt_execute($query);
    }

    public function InsertEvent($UserID, $EventTitle, $EventStart, $EventEnd){
        $query = mysqli_prepare($this->connection, "CALL insert_Event(?,?,?,?)");
        mysqli_stmt_bind_param($query, "isss", $UserID, $EventTitle, $EventStart, $EventEnd);
        mysqli_stmt_execute($query);
    }

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

    public function GetLoginData($email)
    {
        $query = mysqli_prepare($this->connection, "CALL get_Password(?)") or die(mysqli_error($this->connection));
        mysqli_stmt_bind_param($query,"s", $email);

        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        $data = mysqli_fetch_all($result, MYSQLI_NUM);
        return $data;
    }

    public function GetUsersCalenderData($UserID, $StartDate, $EndDate)
    {
        $query1 = mysqli_prepare($this->connection, "CALL get_User_Calender_Events(?, ?, ?)") or die(mysqli_error($this->connection));
        mysqli_stmt_bind_param($query1,"iss", $UserID, $StartDate, $EndDate);

        mysqli_stmt_execute($query1);
        $result1 = mysqli_stmt_get_result($query1);

        $data = mysqli_fetch_all($result1, MYSQLI_ASSOC);

        $output = array();

        foreach($data as $row)
        {
            $output[] = array(
                'id' => "E".$row["ID"],
                'title'   => $row["Title"],
                'start'   => $row["StartTime"],
                'end'   => $row["EndTime"],
            );
        }

        $result1->free();
        $this->connection->next_result();
        //this is required to prevent errors when calling multiple store procedures.

        $query2 = mysqli_prepare($this->connection, "CALL get_User_Calender_Sleeps(?, ?, ?)") or die(mysqli_error($this->connection));
        mysqli_stmt_bind_param($query2,"iss", $UserID, $StartDate, $EndDate);

        mysqli_stmt_execute($query2);
        $result2 = mysqli_stmt_get_result($query2);

        $data = mysqli_fetch_all($result2, MYSQLI_ASSOC);

        foreach($data as $row)
        {
            $output[] = array(
                'id' => "S".$row["ID"],
                'title'   => $row["Title"],
                'start'   => $row["StartTime"],
                'end'   => $row["EndTime"]
            );
        }
        return $output;
    }

    public function DeleteEvent($ID)
    {
        $query = mysqli_prepare($this->connection, "DELETE FROM event WHERE event.EventID =?") or die(mysqli_error($this->connection));
        mysqli_stmt_bind_param($query,"i", $ID);
        mysqli_stmt_execute($query);
    }

    public function DeleteSleep($ID)
    {
        $query = mysqli_prepare($this->connection, "DELETE FROM sleepinstance WHERE sleepinstance.SleepID =?") or die(mysqli_error($this->connection));
        mysqli_stmt_bind_param($query,"i", $ID);
        mysqli_stmt_execute($query);
    }

    public function DeleteUser($ID){
        $query = mysqli_prepare($this->connection, "CALL remove_User(?)");
        mysqli_stmt_bind_param($query, "i", $ID);
        mysqli_stmt_execute($query);
    }

    public function GetSleepRange($Start, $End, $Userid)
    {
        $query = mysqli_prepare($this->connection, "CALL get_Sleep_Range(?,?,?)");
        mysqli_stmt_bind_param($query, "ssi", $Start, $End, $Userid);

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

    public function GetThemeSetting($UserID)
    {
        $query = mysqli_prepare($this->connection, "CALL get_Setting_Theme(?)");
        mysqli_stmt_bind_param($query, "i", $UserID);
        mysqli_stmt_execute($query);
        return mysqli_stmt_get_result($query);
    }

    public function SetThemeSetting($UserID, $NewTheme)
    {
        $query = mysqli_prepare($this->connection, "CALL change_Setting_Theme(?,?)");
        mysqli_stmt_bind_param($query, "ii", $UserID, $NewTheme);
        mysqli_stmt_execute($query);
    }

}

?>