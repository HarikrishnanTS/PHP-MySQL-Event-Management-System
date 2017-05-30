
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>App</title>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
</head>
<body>

<center>

    <?php
    session_start();
    //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
    if(isset($_SESSION['user'])) {
        echo "<a href='login.php' class='btn btn-primary'>Login</a>";
    }
    else {
        echo "<a href='loginpage.php' class='btn btn-primary'>Login</a>";
    }
    ?>
    <a href="registration.html" class="btn btn-primary">Registration</a>


    <h1>
        Create your event and let the world know about it.
    </h1>
    <h3>
        Want to create an event ?
        Just sign up.
    </h3>
    <br>
    <br>
    <br>

</center>
<?php

$servername = "localhost";
$password = "";
$dbname = "myDBPDO";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", 'root', $password);
// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nRows = $conn->query("select count(*) from events")->fetchColumn();

    $dataarray = $conn->query("SELECT * FROM `events` ")->fetchAll();

    $conn = null;

    echo "<div class ='container'>";


    for ($i = 1; $i <= $nRows; $i++) {
        if ($i % 3 == 1) {
            echo "<div class='row'>";
        }
        $image = $dataarray[$i - 1][6];
        $id=$dataarray[$i-1][0];
        $DOC=$dataarray[$i-1][3];
        $DOE=$dataarray[$i-1][2];
        $username=$dataarray[$i-1][4];
        $name=$dataarray[$i - 1][1];
        $description=$dataarray[$i - 1][5];
        echo "<div class='col-lg-4' id='$id'>";

        echo "<div class='thumbnail'><p><strong>Name of Event</strong> : $name</p><div class='thumbnail'>Date of Event : $DOE</div>
                            <img src='/uploads/$image'";

        echo "<div class='thumbnail'><strong> Description :</strong> $description";
        echo "<center><div class='caption'> <a class ='btn btn-primary' href='/deleteevent.php?id=$id'>Delete</a>";
        echo "   <a class=\"btn btn-primary\" href='editeventpage.php?name=$name&id=$id&description=$description'>Edit</a></center>";
        echo "<br><br><div class='thumbnail'>Date of Creation : $DOC<br>By : $username</div></div></div>
              </div>
              </div>";
        if ($i % 3 == 1) {
            echo "<div class='row'>";
        }
        echo "</div>";
    }

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


?>


</body>
</html>