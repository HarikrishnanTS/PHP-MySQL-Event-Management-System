<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDBPDO";



    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $currentDir = getcwd();
        $uploadDirectory = "/uploads/";

        $errors = []; // Store all foreseen and unforseen errors here

        $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileTmpName  = $_FILES['file']['tmp_name'];
        $fileType = $_FILES['file']['type'];
        $fileExtension = strtolower(end(explode('.',$fileName)));

        $uploadPath = $currentDir . $uploadDirectory . basename($fileName);


            if (! in_array($fileExtension,$fileExtensions)) {
                $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
            }

            if ($fileSize > 2000000) {
                $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
            }

            if (empty($errors)) {
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                if ($didUpload) {
                    //echo "The file " . basename($fileName) . " has been uploaded";
                } else {
                    //echo "An error occurred somewhere. Try again or contact the admin";
                }
            } else {
                //foreach ($errors as $error) {
                   // echo $error . "These are the errors" . "\n";
                }




        $username = $_GET['username'];
        $event = $_POST["event"];
        $link=$_POST["link"];
        $description = $_POST["description"];
        $date = $_POST["date"];
        $month = $_POST["month"];
        $mydate = getdate(date("U"));
        $year = $_POST["year"];
        $DOC = "$mydate[mday]$mydate[month]$mydate[year]";
        $DOE = $date . '/' . $month . '/' . $year;

        if(isset($_SESSION['user'])) {

            $sql = "INSERT INTO events (Name,Description,DOE,DOC,Username,Image,Link)
                VALUES ('$event',' $description','$DOE','$DOC','$username','$fileName','$link')";
            // use exec() because no results are returned
            $conn->exec($sql);
            $last_id = $conn->lastInsertId();
        }
        $dataarray=array($event,$description,$DOC,$DOE,$fileName,$username,$link);
        $data['result'] = $dataarray;
        header("Location: /login.php");
        echo json_encode($data);

    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }





