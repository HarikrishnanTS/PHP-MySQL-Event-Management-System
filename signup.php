<?php
namespace SendGrid;
require __DIR__ . 'vendor/autoload.php';
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



                $from = new SendGrid\Email("Example User", "agbilotia1998@gmail.com");
                $subject = "Sending with SendGrid is Fun";
                $to = new SendGrid\Email("Example User", "test@example.com");
                $content = new SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");
                $mail = new SendGrid\Mail($from, $subject, $to, $content);

                $apiKey = getenv('SENDGRID_API_KEY');
                $sg = new \SendGrid($apiKey);

                $response = $sg->client->mail()->send()->post($mail);
                echo $response->statusCode();
                print_r($response->headers());
                echo $response->body();


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


