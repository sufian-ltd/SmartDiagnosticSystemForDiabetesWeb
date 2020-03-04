<?php
    session_start();
    $msg = "";
    if( isset($_POST['login']) ) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username =="admin" && $password =="admin") {
            $_SESSION["USER"]="admin";
            header('Location: home.php');
            exit;
        }
        else {
            $msg = "You entered wrong information...!!!";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/bootstrap-theme.min.css">
    <script src="resources/js/bootstrap.min.js"></script>
</head>
<body style="font-family: serif;color:#fff;background-image: url('images/cc.jpg')">
<div class="container" align="center">
<!--    <h2>Smart Diagnostic System for Diabetes</h2>-->
<!--    <hr/>-->
    <form action="index.php" method="post" style="background-color: #192e38;width: 450px;padding: 15px;margin-top: 120px;">
        <img src="images/aa.jpg" width="420" height="200">
        <div class="input-group">
<!--            <h3>Login</h3>-->
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input type="text" class="form-control" name="username" id="username1" placeholder="Username : "/>
        </div>
        <br/>
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" name="password" id="password1"
                   placeholder="Password : "/>
        </div>
        <br/>
        <div class="input-group">
            <button name="login" style="width: 415px;background-color: #114643;color: white" type="submit" class="btn glyphicon glyphicon-log-in"> Login</button>
        </div>
        <br/>
    </form>
</div>
<br/><br/>
<?php include "includes/footer.php" ?>

</body>
</html>
