
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>App</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css"/>
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'/>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'/>
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
    <span id="span"></span>

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



    echo "<div class='container'>";
    echo "<div class='row'>";
    for ($i = $nRows; $i >=1 ; $i--) {


        $image = $dataarray[$i - 1][6];
        $id=$dataarray[$i-1][0];
        $DOC=$dataarray[$i-1][3];
        $DOE=$dataarray[$i-1][2];
        $username=$dataarray[$i-1][4];
        $name=$dataarray[$i - 1][1];
        $description=$dataarray[$i - 1][5];
        $link=$dataarray[$i-1][7];
        $going=$dataarray[$i-1][8];
        $interested=$dataarray[$i-1][9];

        if($i==$nRows)
            echo "<div class='col-lg-4' id='$id' style='margin-left: 34%'>";

        else
            echo "<div class='col-lg-4' id='$id'>";
        echo "<div class='thumbnail'><p><strong>Name of Event</strong> : $name</p><div class='thumbnail'>Date of Event : $DOE</div>
                            <img src='/uploads/$image'";

        echo "<div class='thumbnail'><strong> Description :</strong> $description<br><a href='$link'>Link to the event</a>";
        echo "<br><br><button class='btn btn-primary' id='interested' onclick='interested($id)'>Interested: $interested</button>";
        echo "  ";
        echo "<button class='btn btn-primary' id='going' onclick='going($id)'>Going: $going  </button>";
        echo "<br><br><div class='thumbnail'>Date of Creation : $DOC<br>By : $username</div></div></div>
              </div>
              </div>";

    }

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}


?>

<script>

function interested(id) {


    $.ajax({
        type: "POST",
        url: 'updateinterest.php?id='+id,
        dataType: 'json',
        success: function (data) {
            $('#'+id).find("#interested").text('Interested :' + data.result[0]);
            $('#'+id).find("#interested").addClass('disabled');
            },
        error: function (err) {
            console.log(err);

        }
    });
}

function going(id) {

    $.ajax({

        type: "POST",
        dataType: 'json',
        url: 'updategoing.php?id=' + id,
        success: function (data) {
            //$(this).text('Going :' + data.result[0].toString());
            $('#'+id).find("#going").text('Going : ' + data.result[0].toString());
            $('#'+id).find("#going").addClass('disabled');
            },

        error: function (err) {
            console.log(err);

        }
    });

}
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>