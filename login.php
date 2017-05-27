<html>
<head>
    <title>
        Create your event.
    </title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <script src="main.js"></script>
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

    "<input type='hidden' name='username' value='$username'>";

    $stmt = $conn->query("SELECT * FROM users WHERE username='$username'");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row['username'] == $username && $row['password'] == $password) {
        echo 'Welcome ', $row['name'], "<br>";
    } else {
        echo 'Error Logging In !';
    }
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}

?>


<!-- Large modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Create Event
</button>

<a type="button" class="btn btn-primary" href="index.php">Log Out</a>


<h1>
    <center>
        Your Events.
        <br>
        <br>

    </center>
</h1>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     id="myModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">New Event</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="submitform" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label">Name of Event:</label>
                        <input type="text" class="form-control" id="recipient-name" name="event">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Description:</label>
                        <textarea class="form-control" id="message-text" name="description"></textarea>
                    </div>


                    <div class="form-group">
                        Upload a File:
                        <input type="file" name="file" id="fileToUpload">
                    </div>

                    <div class="form-group">
                        <label for="doe" class="control-label">Date of Event:</label>
                        <br>
                        <in class="form-group">

                            <label>DAY</label>
                            <select name="date">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</opt
                                    ion>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>

                                <option>21</option>
                                <option>22</option>
                                <option>23</option>
                                <option>24</option>
                                <option>25</option>
                                <option>26</option>
                                <option>27</option>
                                <option>28</option>
                                <option>29</option>
                                <option>30</option>
                                <option>31</option>
                            </select>

                            <label>Month</label>
                            <select name="month">
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                            </select>

                            <label>Year</label>
                            <select name="year">
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                                <option>2027</option>
                                <option>2028</option>
                                <option>2029</option>
                                <option>2030</option>
                                <option>2031</option>
                                <option>2032</option>
                            </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
                        <input type="submit" class="btn btn-primary" name="Done" value="Done" id="Done">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php

$servername = "localhost";
$password = "";
$dbname = "myDBPDO";
$username = $_POST["username"];


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", 'root', $password);
// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nRows = $conn->query("select count(*) from events WHERE username='$username'")->fetchColumn();

    $dataarray = $conn->query("SELECT * FROM `events` WHERE Username='$username' ")->fetchAll();

    $conn = null;

    echo "<div class ='container'>";


    for ($i = 1; $i <= $nRows; $i++) {
        if ($i % 3 == 1) {
            echo "<div class='row'>";
        }
        $image = $dataarray[$i - 1][5];
        echo "<div class='col-lg-4'>";
        echo $dataarray[$i - 1][0];
        echo "<div class='thumbnail'>
                            <img src='/uploads/$image'";

        echo "<center><div class='caption'>";
        echo $dataarray[$i - 1][4];
        echo "</center>";
        echo "</div>
         
                            </div>
                            </div>";
    }

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>


<script>

    //
    //    $("#uploadform").on("submit",function (event) {
    //        event.preventDefault();
    //
    //        $.ajax({
    //            type:"POST",
    //            url:'upload.php',
    //            data:new FormData(this),
    //            contentType: false,
    //            dataType:'text',
    //            success: function(data){
    //
    //
    //            },
    //            error:function (err) {
    //                console.log(err);
    //                alert(err);
    //            }
    //        });
    //    });
    //

    $("#submitform").on("submit", function (event) {
        event.preventDefault();
        console.log($(this).serialize());
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        var username = '<?php echo $username; ?>';
        // alert(formdata);
        $.ajax({
            type: "POST",
            url: 'addEvent.php?username=' + username,
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (data) {


                //alert(data.result[0]);
                $('#close').click();
                $('.container').append("<div class='col-lg-4'>" + data.result[0] + "<div class='thumbnail'>" +
                    "<img src='/uploads/" + data.result[4] + "'>" + "<div class='caption'>" + data.result[1] + "</div>"
                    + "</div>");


            },
            error: function (err) {
                console.log(err);
                alert(err);

            }
        });
    });

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>