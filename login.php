<html>
<head>
    <title>
        Create your event.
    </title>
</head>
<body>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDBPDO";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['username'] == $username && $row['password'] == $password) {
        echo  'Welcome',$row['name'];
    } else {
        echo 'Error Logging In !';
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

?>



</body>
</html>