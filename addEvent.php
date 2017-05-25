<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDBPDO";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username=$_GET['username'];
    $event = $_POST["event"];
    $description = $_POST["description"];
    $date = $_POST["date"];
    $month = $_POST["month"];
    $mydate=getdate(date("U"));
    $year = $_POST["year"];
    $DOC="$mydate[mday]$mydate[month]$mydate[year]";
    $DOE=$date.'/'.$month.'/'.$year;
    $dataarray=array($event,$description,$DOC,$DOE,$username);

                $sql = "INSERT INTO events (Name,Description,DOE,DOC,Username)
                VALUES ('$event',' $description','$DOE','$DOC','$username')";
                // use exec() because no results are returned
                $conn->exec($sql);
                $conn = null;

    $data['result'] = $dataarray;
    echo json_encode($data);

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


