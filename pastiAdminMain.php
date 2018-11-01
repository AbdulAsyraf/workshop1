<?php

require_once "../../configs/pastiConfig.php";

session_start();

//check for logged in status
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["usertype"] !== 2){
    header("location: pastiLogin.php");
    exit;
}

?>
<?php
$filter = mysqli_query($link, "SELECT username from users");

while($row = mysqli_fetch_array($filter, MYSQLI_ASSOC){
?>

    <option value = "teacher"><?php echo $row["name"]; ?></option>

<?php

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
    
    <p>
        <a href="pastiLogout.php" class="btn btn-danger">Sign Out</a>
    </p>
</body>
</html>