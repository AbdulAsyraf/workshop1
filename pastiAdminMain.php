<?php

require_once "../../configs/pastiConfig.php";

session_start();

//check for logged in status
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["usertype"] !== 2){
    header("location: pastiLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Application</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="page-header">
        <h1>Hi admin <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
    </div>
    
    <p><input type="button" value="Approve Students" onclick="location='pastiAdminApprove.php'">
    <p><input type="button" value="Remove Students" onclick="location='pastiAdminRemove.php'">
    <p><input type="button" value="Add/Remove Teacher" onclick="location='pastiAdminAddTeacher.php'">
    <p><a href="pastiLogout.php" class="btn btn-danger">Sign Out</a></p>
</body>
</html>