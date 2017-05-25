<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDBPDO";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];
    $email = $_POST["email"];

    $nRows = $conn->query("select count(*) from users WHERE username='$username'")->fetchColumn();
    //echo $nRows;
    if ($nRows == 0) {
        $nRows = $conn->query("select count(*) from users WHERE email='$email'")->fetchColumn();
        if ($nRows == 0) {
            if ($password == $confirm) {
                $sql = "INSERT INTO Users (name, password, email,username)
                VALUES ('$name',' $password','$email','$username')";
                // use exec() because no results are returned
                $conn->exec($sql);
                $conn = null;

                echo 'Thankyou ', $name, ' For Registering.';
            } else {
                echo "Confirm password field didnot match.";
            }
        } else {
            echo "Email already exists";
        }
    } else {
        echo "Username already exists";
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


