<?php

$connect = new PDO('mysql:host="proj-mysql.uopnet.plymouth.ac.uk";dbname=prco204_y', 'PRCO204_Y', 'auCw5WTCsg4L66ce');

$data = array();

$query = "SELECT * FROM events ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
    $data[] = [
        'title'   => $row["title"],
        'start'   => $row["start_event"],
        'end'   => $row["end_event"]
    ];
}

echo json_encode($data);

?>