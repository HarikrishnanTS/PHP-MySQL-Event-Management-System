<?php
session_start();



if(isset($_SESSION['user'])){
    header("Location: /login.php");
}
?>
<html>
<head>
    <title>
        Login
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
</head>

<body>
<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
                <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a>
                </div>
            </div>

            <div style="padding-top:30px" class="panel-body">

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                <form id="loginform" class="form-horizontal" method="post" action="login.php">


                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value=""
                               placeholder="username" required>
                    </div>


                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password"
                               placeholder="password" required>
                    </div>


                    <div class="input-group">
                        <div class="checkbox">
                            <label>
                                <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                            </label>
                        </div>
                    </div>


                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                            <input type="submit" id="btn-login" class="btn btn-success" value="Login">
                        </div>
                    </div>

                    <?php
                   // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
                    if(isset($_SESSION['message'])) {
                            echo "<center><span id='message' class='alert alert-danger'>" ;
                            echo $_SESSION['message'];
                            $_SESSION['message']=null;
                    }

                    echo "</span></center>";



                    ?>



                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div style="padding-top:20px; font-size:85%">
                                Don't have an account!
                                <a href="registration.html" target="_blank">
                                    Sign Up Here
                                </a>
                            </div>
                        </div>
                    </div>


                </form>


            </div>
        </div>
    </div>
</div>

<!--<script type="text/javascript">-->
    <!--$("#loginform").on("submit", function (event) {-->
        <!--event.preventDefault();-->
        <!--console.log($(this).serialize());-->
        <!--var formdata = $(this).serialize();-->
        <!--// alert(formdata);-->
        <!--$.ajax({-->
            <!--type: "POST",-->
            <!--url: "login.php",-->
            <!--dataType: 'text',-->
            <!--data: formdata,-->
            <!--success: function (data) {-->
                <!--$("#message").addClass('alert');-->
                <!--$("#message").addClass('alert-danger');-->
                <!--$("#message").text(data);-->
            <!--},-->
            <!--error: function (err) {-->
                <!--console.log(err);-->
                <!--alert(err);-->
            <!--}-->
        <!--});-->
    <!--});-->
<!--</script>-->
</body>
</html>