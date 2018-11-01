<?php

session_start();

//check for logged in status
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["usertype"] !== 0){
    header("location: pastiLogin.php");
    exit;
}

$query = "SELECT username from users";
$result = mysqli_query($link, $query);

while($row = mysqli_fetch_array($link, $result)){
    echo "<p>" . $row['username'] . "</p>";
}
mysqli_close($link);

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
        <h1>Hi user <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
    </div>
    <p><input type="button" value="Add Parent or Guardian" onclick="location='pastiNewParent.php'" /></p>
    <p><input type="button" value="Add Student" onclick="location='pastiNewStudent.php'" /></p>
    <p><a href="pastiLogout.php" class="btn btn-danger">Sign Out</a></p>
</body>
</html>