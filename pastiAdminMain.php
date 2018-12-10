<?php

require_once "../../configs/pastiConfig.php";
include_once "pastiFeeReport";

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
    <title>Main Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="page-header">
        <h1>Hi <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
    </div>
    

    <?php

        if($percentage > 30){
            echo "<p>ATTENTION! Too much fees are unpaid! Please take action.</p>";
        }

    ?>
    <p><input type="button" value="Approve Students" onclick="location='pastiAdminApprove.php'">
    <p><input type="button" value="Remove Students" onclick="location='pastiAdminRemove.php'">
    <p><input type="button" value="Add/Remove Teacher" onclick="location='pastiAdminAddTeacher.php'">
    <p><input type="button" value="Fee Payment" onclick="location='pastiFee.php'">
    <p><input type="button" value="Report" onclick="location='pastiFeeReport.php'">
    <p><input type="button" value="View Students" onclick="location='pastiSearch.php'">
    <p><input type="button" value="Sign Out" onclick="location='pastiLogout.php'" class="btn btn-danger"></p>
</body>
</html>