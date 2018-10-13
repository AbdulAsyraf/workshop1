<?php

session_start();

//check for logged in status
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["usertype"] !== 0){
    header("location: pastiLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Application</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{width: 350px; padding: 20px; }
    </style>
<body>
    <div class="page-header">
        <h1>Hi user <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
    </div>
    <p><input type="button" value="New Application" onclick="location='pastiApply.php'" /></p>
    <p><a href="pastiLogout.php" class="btn btn-danger">Sign Out</a></p>
</body>
</html>